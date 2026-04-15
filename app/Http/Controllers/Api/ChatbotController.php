<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private array $stopWords = [
        'a','an','the','is','are','was','were','be','been','being','have','has','had',
        'do','does','did','will','would','could','should','may','might','can','shall',
        'what','who','where','when','why','how','which',
        'i','me','my','we','our','you','your','it','its','he','she','they','them','their',
        'this','that','these','those','and','or','but','if','so','as','at','by','for',
        'from','in','into','of','on','to','with','about','just','also','some','any','all',
        'please','tell','give','show','list','get','more','latest','recent','new','news',
        'update','updates','us','article','articles','post','posts','info','information',
    ];

    /* ------------------------------------------------------------------ */
    /*  chatbotData — returns the full article list (used by the API route) */
    /* ------------------------------------------------------------------ */
    public function chatbotData()
    {
        $articles = Article::latest()->get(['id', 'title', 'content', 'created_at', 'updated_at']);

        $data = $articles->map(function ($article) {
            $contentPath = public_path("Uploads/News/content/{$article->content}");
            $contentText = 'Content not available';

            if (!empty($article->content) && File::exists($contentPath)) {
                $rawContent = File::get($contentPath);
                $cleanText  = preg_replace('/\s+/', ' ', strip_tags($rawContent));
                $contentText = mb_substr($cleanText, 0, 500) . (strlen($cleanText) > 500 ? '...' : '');
            }

            $title = strip_tags($article->title);
            if (class_exists('\Normalizer')) {
                $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $title = transliterator_transliterate('NFKC', $title);
            }
            $title = preg_replace('/\p{Cf}/u', '', $title);

            return [
                'title'      => $title,
                'content'    => $contentText,
                'url'        => route('view-article', ['id' => $article->id]),
                'created_at' => $article->created_at->toDateTimeString(),
                'updated_at' => $article->updated_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'source' => 'CPSU Website - Articles',
            'total'  => $data->count(),
            'data'   => $data,
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  chat — receives a message, queries Claude, returns a reply         */
    /* ------------------------------------------------------------------ */
    public function chat(Request $request)
    {
        $message = trim($request->input('message', ''));
        $history = $request->input('history', []);

        if ($message === '') {
            return response()->json(['reply' => 'Please enter a message.'], 400);
        }

        $noInfo     = "I'm sorry, I don't have information about that in my knowledge base. Please visit the CPSU website or contact the university directly for more details.";
        $outOfScope = "I can only answer questions about Central Philippines State University (CPSU). For other inquiries, please visit the CPSU website or contact the university directly.";

        // ── Instant replies for greetings (no AI call) ──────────────────
        $lower     = strtolower($message);
        $greetings = ['hi','hello','hey','good morning','good afternoon','good evening','kumusta','musta'];
        foreach ($greetings as $g) {
            if ($lower === $g || str_starts_with($lower, $g . ' ') || str_ends_with($lower, ' ' . $g)) {
                return response()->json(['reply' => "Hi there! 👋 I'm Kaloy, your CPSU assistant. You can ask me about CPSU news, events, programs, and announcements!"]);
            }
        }
        if (preg_match('/\bhow are you\b/i', $message)) {
            return response()->json(['reply' => "I'm doing great, thanks for asking! 😊 How can I help you with CPSU today?"]);
        }
        if (preg_match('/\bthank(s| you)\b/i', $message)) {
            return response()->json(['reply' => "You're welcome! 😊 Let me know if you have any other questions about CPSU."]);
        }

        // ── Get relevant articles from the DB ───────────────────────────
        $articles = $this->getRelevantArticles($message);

        if (empty($articles)) {
            return response()->json(['reply' => $noInfo]);
        }

        // ── Build knowledge context ──────────────────────────────────────
        $knowledge = collect($articles)
            ->map(fn($a) => "Title: {$a['title']}\nSummary: {$a['content']}\nURL: {$a['url']}")
            ->implode("\n\n---\n\n");

        $systemPrompt =
            "You are Kaloy, the friendly and helpful official chatbot of Central Philippines State University (CPSU).\n\n"
            . "YOUR ONLY SOURCE OF TRUTH is the CPSU Knowledge Base provided below. You must NEVER use outside knowledge.\n\n"
            . "RULES:\n"
            . "1. Answer ONLY using the knowledge base below. Do not add details not written there.\n"
            . "2. If the answer is not in the knowledge base, respond with exactly: \"{$noInfo}\"\n"
            . "3. If the question is unrelated to CPSU, respond with exactly: \"{$outOfScope}\"\n"
            . "4. Be warm, conversational, and concise (2-4 sentences).\n"
            . "5. When mentioning an article, always include it as a markdown link: [Article Title](URL)\n\n"
            . "CPSU Knowledge Base:\n{$knowledge}";

        // ── Build messages array (last 3 exchanges for context) ──────────
        $messages = [];
        foreach (array_slice((array) $history, -6) as $h) {
            if (!empty($h['role']) && !empty($h['content'])) {
                $messages[] = ['role' => $h['role'], 'content' => (string) $h['content']];
            }
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        // ── Call Claude API ──────────────────────────────────────────────
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'x-api-key'         => env('CLAUDE_API_KEY'),
                    'anthropic-version' => '2023-06-01',
                    'content-type'      => 'application/json',
                ])
                ->post('https://api.anthropic.com/v1/messages', [
                    'model'      => env('CLAUDE_MODEL', 'claude-3-5-haiku-20241022'),
                    'max_tokens' => 512,
                    'system'     => $systemPrompt,
                    'messages'   => $messages,
                ]);

            if (! $response->ok()) {
                Log::error('Claude API error: ' . $response->status() . ' ' . $response->body());
                return response()->json(['reply' => $noInfo]);
            }

            $data  = $response->json();
            $reply = $data['content'][0]['text'] ?? $noInfo;

            // Guarantee article titles in the reply are clickable links
            $reply = $this->injectArticleLinks($reply, $articles);

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Claude API exception: ' . $e->getMessage());
            return response()->json(['reply' => '❌ Unable to connect right now. Please try again shortly.']);
        }
    }

    /* ------------------------------------------------------------------ */
    /*  Private helpers                                                    */
    /* ------------------------------------------------------------------ */

    private function getRelevantArticles(string $message, int $max = 5): array
    {
        $articles = Article::latest()->get(['id', 'title', 'content']);

        $mapped = $articles->map(function ($article) {
            $contentPath = public_path("Uploads/News/content/{$article->content}");
            $contentText = '';
            if (!empty($article->content) && File::exists($contentPath)) {
                $raw = File::get($contentPath);
                $contentText = mb_substr(preg_replace('/\s+/', ' ', strip_tags($raw)), 0, 500);
            }
            return [
                'title'   => strip_tags($article->title),
                'content' => $contentText,
                'url'     => route('view-article', ['id' => $article->id]),
            ];
        })->toArray();

        // Tokenise query into meaningful keywords
        $words    = preg_split('/\s+/', preg_replace('/[^a-z0-9 ]/i', ' ', strtolower($message)));
        $keywords = array_values(array_filter($words, fn($w) => strlen($w) > 2 && ! in_array($w, $this->stopWords)));

        // No meaningful keywords → return latest articles (e.g. "latest news")
        if (empty($keywords)) {
            return array_slice($mapped, 0, $max);
        }

        // Score each article
        $scored = array_map(function ($a) use ($keywords) {
            $text  = strtolower($a['title'] . ' ' . $a['content']);
            $score = array_reduce($keywords, fn($n, $w) => $n + (str_contains($text, $w) ? 1 : 0), 0);
            return array_merge($a, ['_score' => $score]);
        }, $mapped);

        $matched = array_filter($scored, fn($a) => $a['_score'] > 0);

        // No keyword matches → fall back to latest articles (handles "latest article", "recent post", etc.)
        if (empty($matched)) {
            return array_slice($mapped, 0, $max);
        }

        usort($matched, fn($a, $b) => $b['_score'] <=> $a['_score']);

        return array_slice(array_values($matched), 0, $max);
    }

    private function injectArticleLinks(string $text, array $articles): string
    {
        // Sort longest titles first to avoid partial matches
        usort($articles, fn($a, $b) => strlen($b['title']) - strlen($a['title']));

        foreach ($articles as $article) {
            if (empty($article['title']) || empty($article['url'])) {
                continue;
            }
            $escaped = preg_quote($article['title'], '/');
            // Only wrap if not already inside a markdown link [...]
            $text = preg_replace(
                "/(?<!\[)({$escaped})(?![^\[]*\])/iu",
                "[{$article['title']}]({$article['url']})",
                $text
            );
        }

        return $text;
    }
}

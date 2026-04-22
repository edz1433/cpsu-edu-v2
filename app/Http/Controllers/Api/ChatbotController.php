<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Sublink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private const KB_CACHE_KEY = 'cpsu_chatbot_kb_v9';
    private const KB_CACHE_TTL = 300;           // 5 minutes
    private const MAX_SNIPPET = 2600;
    private const MAX_MATCHES = 5;
    private const MAX_HISTORY = 6;
    private const DEFAULT_LIST_LIMIT = 3;
    private const MAX_LIST_LIMIT = 20;

    private string $assistantName = 'Kaloy';
    private string $noInfo = "I'm sorry, but I can only answer based on official CPSU content I have access to, and I don't see that information here yet.";
    private string $outOfScope = "I can only answer using official CPSU content available in the system.";

    private array $stopWords = [
        'a','an','the','is','are','was','were','be','been','being','have','has','had',
        'do','does','did','will','would','could','should','may','might','can','shall',
        'what','who','where','when','why','how','which',
        'i','me','my','we','our','you','your','it','its','he','she','they','them','their',
        'this','that','these','those','and','or','but','if','so','as','at','by','for',
        'from','in','into','of','on','to','with','about','just','also','some','any','all',
        'please','tell','give','show','list','get','more','us','info','information',
        'about','regarding','know','news','article','articles'
    ];

    public function chatbotData()
    {
        return response()->json($this->knowledgeBase());
    }

    public function chat(Request $request): JsonResponse
    {
        $message = trim((string) $request->input('message', ''));
        $history = $request->input('history', []);

        if ($message === '') {
            return response()->json([
                'reply' => 'Please enter a message.',
                'sources' => []
            ], 400);
        }

        // Quick special intents
        if ($this->isGreeting($message)) {
            return $this->successResponse(
                "Hi! 👋 I'm {$this->assistantName}, the official AI chatbot of CPSU. Ask me about official CPSU content, announcements, pages, news, and website information."
            );
        }

        if ($this->isNameQuestion($message)) {
            return $this->successResponse(
                "I'm {$this->assistantName}, the official AI chatbot of CPSU."
            );
        }

        if ($this->isSuggestionRequest($message)) {
            return $this->successResponse($this->suggestionReply());
        }
        
        // Check for out-of-scope questions FIRST
        if ($this->isOutOfScopeQuery($message)) {
            return $this->successResponse($this->outOfScope);
        }

        $kb = $this->knowledgeBase();
        $entries = $kb['data'] ?? [];

        if (empty($entries)) {
            return $this->successResponse(
                "There is no official CPSU content available right now."
            );
        }

        $intent = $this->detectIntent($message, $history);
        $listLimit = $this->extractRequestedLimit($message, $history);

        if ($intent === 'latest') {
            $limited = array_slice($entries, 0, $listLimit);
            return $this->successResponse(
                $this->formatArticleList(
                    $limited,
                    "Here are the latest {$listLimit} CPSU content " . ($listLimit > 1 ? 'entries' : 'entry') . ":"
                ),
                $this->prepareSources($limited)
            );
        }

        $matchedEntries = $this->searchArticles($message, $entries, self::MAX_MATCHES);

        if (empty($matchedEntries)) {
            if ($this->isBroadCpsuQuery($message)) {
                $limited = array_slice($entries, 0, min($listLimit, 5));
                return $this->successResponse(
                    $this->formatArticleList(
                        $limited,
                        "I couldn't find an exact match, but here are some recent CPSU content entries you may want to check:"
                    ),
                    $this->prepareSources($limited)
                );
            }

            return $this->successResponse($this->noInfo);
        }

        if ($this->isPresidentQuery($message)) {
            $presidentReply = $this->answerPresidentQuery($message, $matchedEntries);
            return $this->successResponse(
                $presidentReply ?: $this->noInfo,
                $this->prepareSources($matchedEntries)
            );
        }

        if ($intent === 'list') {
            $limited = array_slice($matchedEntries, 0, $listLimit);
            return $this->successResponse(
                $this->formatArticleList(
                    $limited,
                    "Here are {$listLimit} CPSU content " . ($listLimit > 1 ? 'entries' : 'entry') . " related to your question:"
                ),
                $this->prepareSources($limited)
            );
        }

        // Try LLM first (best quality)
        $modelReply = $this->askModel($message, $history, $matchedEntries);
        if ($modelReply !== null) {
            return $this->successResponse(
                $modelReply,
                $this->prepareSources($matchedEntries)
            );
        }

        // Fallback to extractive answer
        return $this->successResponse(
            $this->buildExtractiveFallback($message, $matchedEntries),
            $this->prepareSources($matchedEntries)
        );
    }

    /**
     * New structured JSON response helper (AI JSON format)
     * Makes frontend rendering super easy and responses clean.
     */
    private function successResponse(string $reply, array $sources = []): JsonResponse
    {
        return response()->json([
            'reply'   => $reply,
            'sources' => $sources,
        ]);
    }

    private function knowledgeBase(): array
    {
        return Cache::remember(self::KB_CACHE_KEY, self::KB_CACHE_TTL, function () {
            $data = collect();

            // Articles
            $articles = Article::query()
                ->latest('created_at')
                ->get(['id', 'title', 'content', 'created_at', 'updated_at']);

            $data = $data->merge(
                $articles->map(fn($article) => [
                    'id'         => 'article_' . $article->id,
                    'type'       => 'article',
                    'title'      => $this->normalize(strip_tags((string) $article->title)),
                    'content'    => $this->loadStoredContentFile((string) $article->content, 'article'),
                    'url'        => route('view-article', ['id' => $article->id]),
                    'created_at' => optional($article->created_at)?->toDateTimeString(),
                    'updated_at' => optional($article->updated_at)?->toDateTimeString(),
                    'timestamp'  => optional($article->created_at)?->timestamp ?? 0,
                ])
            );

            // Categories
            $categories = Category::query()
                ->latest('created_at')
                ->get(['id', 'cat_name', 'cat_url', 'created_at', 'updated_at']);

            $data = $data->merge(
                $categories->map(fn($category) => [
                    'id'         => 'category_' . $category->id,
                    'type'       => 'category',
                    'title'      => $this->normalize(strip_tags((string) $category->cat_name)),
                    'content'    => $this->normalize(strip_tags((string) $category->cat_name)),
                    'url'        => !empty($category->cat_url) ? url($category->cat_url) : '#',
                    'created_at' => optional($category->created_at)?->toDateTimeString(),
                    'updated_at' => optional($category->updated_at)?->toDateTimeString(),
                    'timestamp'  => optional($category->created_at)?->timestamp ?? 0,
                ])
            );

            // Subcategories
            $subcategories = DB::table('sub_categories as sc')
                ->leftJoin('categories as c', 'c.id', '=', 'sc.categories_id')
                ->select('sc.id', 'sc.title', 'sc.created_at', 'sc.updated_at', 'c.cat_name as category_name')
                ->orderByDesc('sc.created_at')
                ->get();

            $data = $data->merge(
                $subcategories->map(fn($sub) => [
                    'id'         => 'subcategory_' . $sub->id,
                    'type'       => 'subcategory',
                    'title'      => $this->normalize(strip_tags((string) $sub->title)),
                    'content'    => $this->normalize(strip_tags($sub->title . ' ' . $sub->category_name)),
                    'url'        => '#',
                    'created_at' => optional($sub->created_at)?->toDateTimeString(),
                    'updated_at' => optional($sub->updated_at)?->toDateTimeString(),
                    'timestamp'  => optional($sub->created_at)?->timestamp ?? 0,
                ])
            );

            // Submenus
            $submenus = DB::table('submenus as sm')
                ->leftJoin('sub_categories as sc', 'sc.id', '=', 'sm.subcategory')
                ->leftJoin('categories as c', 'c.id', '=', 'sc.categories_id')
                ->select(
                    'sm.id', 'sm.title', 'sm.content', 'sm.category', 'sm.subcategory',
                    'sm.url', 'sm.created_at', 'sm.updated_at',
                    'sc.title as subcategory_title', 'c.cat_name as category_name'
                )
                ->where('sm.status', 1)
                ->orderByDesc('sm.created_at')
                ->get();

            $data = $data->merge(
                $submenus->map(fn($sm) => [
                    'id'         => 'submenu_' . $sm->id,
                    'type'       => 'submenu',
                    'title'      => $this->normalize(strip_tags((string) $sm->title)),
                    'content'    => $this->normalize(strip_tags(
                        $this->loadStoredContentFile((string) $sm->content, 'submenu') . ' ' .
                        $sm->subcategory_title . ' ' . $sm->category_name
                    )),
                    'url'        => !empty($sm->url) ? url($sm->url) : '#',
                    'created_at' => optional($sm->created_at)?->toDateTimeString(),
                    'updated_at' => optional($sm->updated_at)?->toDateTimeString(),
                    'timestamp'  => optional($sm->created_at)?->timestamp ?? 0,
                ])
            );

            // Sublinks
            $sublinks = Sublink::query()
                ->where('status', 1)
                ->latest('created_at')
                ->get(['id', 'title', 'content', 'category', 'created_at', 'updated_at']);

            $data = $data->merge(
                $sublinks->map(fn($sl) => [
                    'id'         => 'sublink_' . $sl->id,
                    'type'       => 'sublink',
                    'title'      => $this->normalize(strip_tags((string) $sl->title)),
                    'content'    => $this->normalize(strip_tags(
                        $this->loadStoredContentFile((string) $sl->content, 'sublink') . ' ' . $sl->category
                    )),
                    'url'        => '#',
                    'created_at' => optional($sl->created_at)?->toDateTimeString(),
                    'updated_at' => optional($sl->updated_at)?->toDateTimeString(),
                    'timestamp'  => optional($sl->created_at)?->timestamp ?? 0,
                ])
            );

            return [
                'source' => 'CPSU Website - Articles, Categories, Subcategories, Submenus, Sublinks',
                'total'  => $data->count(),
                'data'   => $data->sortByDesc('timestamp')->values()->toArray(),
            ];
        });
    }

    private function loadStoredContentFile(string $filename, string $type = 'article'): string
    {
        $filename = trim($filename);
        if ($filename === '') {
            return 'Content not available.';
        }

        $path = $this->resolveStoredContentPath($filename, $type);
        if ($path === null) {
            return 'Content not available.';
        }

        try {
            $raw = File::get($path);
            $clean = strip_tags($raw);
            $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $clean = preg_replace('/\s+/u', ' ', $clean);
            $clean = trim($clean);

            return mb_strlen($clean) > self::MAX_SNIPPET
                ? mb_substr($clean, 0, self::MAX_SNIPPET) . '...'
                : $clean;
        } catch (\Throwable $e) {
            Log::warning('Failed to load stored content file', [
                'file' => $filename,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);
            return 'Content not available.';
        }
    }

    private function resolveStoredContentPath(string $filename, string $type = 'article'): ?string
    {
        foreach ($this->candidateContentPaths($filename, $type) as $relativePath) {
            $absolutePath = public_path($relativePath);
            if (File::exists($absolutePath) && File::isFile($absolutePath)) {
                return $absolutePath;
            }
        }
        return null;
    }

    private function candidateContentPaths(string $filename, string $type = 'article'): array
    {
        $filename = trim(str_replace('\\', '/', $filename), '/');
        $basename = basename($filename);

        $foldersByType = [
            'article' => ['Uploads/News/content', 'Uploads/News'],
            'submenu' => ['Uploads/Submenu/content', 'Uploads/Submenu'],
            'sublink' => ['Uploads/Sublink/content', 'Uploads/Sublink'],
        ];

        $folders = array_merge(
            $foldersByType[$type] ?? $foldersByType['article'],
            ['Uploads/Files', 'Uploads/highlights', 'Uploads/international-banner', 'Uploads/page-banner', 'Uploads/Videos']
        );

        $candidates = [];
        if ($filename !== '') {
            $candidates[] = $filename;
        }
        if ($basename !== '' && $basename !== $filename) {
            $candidates[] = $basename;
        }

        foreach ($folders as $folder) {
            $candidates[] = trim($folder . '/' . $filename, '/');
            $candidates[] = trim($folder . '/' . $basename, '/');
        }

        return array_values(array_unique($candidates));
    }

    private function detectIntent(string $message, array $history = []): string
    {
        $m = mb_strtolower($this->normalize($message));

        if (preg_match('/\b(latest|recent|newest|new|updates|latest news|latest articles|recent articles)\b/u', $m)) {
            return 'latest';
        }

        if (preg_match('/\b(show|list|display|give me|send me)\b/u', $m)) {
            return 'list';
        }

        if ($this->isListCorrection($message, $history)) {
            return $this->lastListIntentFromHistory($history) ?? 'latest';
        }

        return 'question';
    }

    private function extractRequestedLimit(string $message, array $history = []): int
    {
        if (preg_match('/\b([0-9]{1,2})\b/', $message, $m)) {
            return max(1, min(self::MAX_LIST_LIMIT, (int) $m[1]));
        }

        if ($this->isListCorrection($message, $history) && preg_match('/\b([0-9]{1,2})\b/', $message, $m)) {
            return max(1, min(self::MAX_LIST_LIMIT, (int) $m[1]));
        }

        return self::DEFAULT_LIST_LIMIT;
    }

    private function isGreeting(string $message): bool
    {
        return preg_match('/^(hi|hello|hey|kumusta|musta|good morning|good afternoon|good evening)\b/iu', trim($message)) === 1;
    }

    private function isNameQuestion(string $message): bool
    {
        $m = mb_strtolower($this->normalize($message));
        return preg_match('/\b(what is your name|what\'s your name|who are you|your name again|name again)\b/u', $m) === 1;
    }

    private function isSuggestionRequest(string $message): bool
    {
        $m = mb_strtolower($this->normalize($message));
        return preg_match('/\b(any suggestions|suggestions|what can you do|help me|sample questions|examples)\b/u', $m) === 1;
    }

    private function suggestionReply(): string
    {
        return "Sure! Here are some things you can ask me:\n\n" .
               "- What are the latest 10 CPSU announcements?\n" .
               "- Show official CPSU pages about admission\n" .
               "- Summarize the CPSU content about scholarships\n" .
               "- What does the website say about a specific office or service?\n" .
               "- List recent official CPSU content\n\n" .
               "Just type your question naturally and I'll answer using only official CPSU content.";
    }

    private function isBroadCpsuQuery(string $message): bool
    {
        return preg_match('/\b(cpsu|news|article|articles|announcement|announcements|event|events|update|updates|page|pages|policy|policies|faq)\b/iu', $message) === 1;
    }

    private function isListCorrection(string $message, array $history): bool
    {
        $m = mb_strtolower($this->normalize($message));
        if (!preg_match('/\b(i said|make it|give me|show me)\b/u', $m) || !preg_match('/\b([0-9]{1,2})\b/', $m)) {
            return false;
        }

        foreach (array_reverse(array_slice($history, -4)) as $item) {
            $content = mb_strtolower((string) ($item['content'] ?? ''));
            if (str_contains($content, 'latest') || str_contains($content, 'article') || str_contains($content, 'content')) {
                return true;
            }
        }
        return false;
    }

    private function lastListIntentFromHistory(array $history): ?string
    {
        foreach (array_reverse(array_slice($history, -6)) as $item) {
            $content = mb_strtolower((string) ($item['content'] ?? ''));
            if (str_contains($content, 'latest')) return 'latest';
            if (str_contains($content, 'article') || str_contains($content, 'content')) return 'list';
        }
        return null;
    }

    private function isPresidentQuery(string $message): bool
    {
        $m = mb_strtolower($this->normalize($message));
        return preg_match('/\b(president|school president|university president|college president|head)\b/u', $m) === 1;
    }

    /**
     * Detect if the question is completely outside CPSU's scope
     * (coding, math, general knowledge, non-CPSU topics)
     */
    private function isOutOfScopeQuery(string $message): bool
    {
        $m = mb_strtolower($this->normalize($message));
        
        // Programming/coding related
        $codingPatterns = [
            '/\b(code|coding|program|programming|function|algorithm|debug|variable|loop|array|object|class|javascript|python|java|php|react|angular|vue|html|css|sql|mysql|database query)\b/i',
            '/\b(calculator|app|application|software|website builder|build a|create a|make a)\b.*\b(using|with)\b/i',
            '/\b(how to (code|program|write|build|create))\b/i',
        ];
        
        foreach ($codingPatterns as $pattern) {
            if (preg_match($pattern, $m)) {
                return true;
            }
        }
        
        // Math/problem solving (non-CPSU)
        $mathPatterns = [
            '/\b(solve|calculate|compute|equation|formula|algebra|geometry|calculus|math|mathematics)\b/i',
            '/\b[0-9\+\-\*\/\(\)\=]+\s*[=]\s*[0-9]+\b/', // math expressions like 2+2=
        ];
        
        foreach ($mathPatterns as $pattern) {
            if (preg_match($pattern, $m)) {
                return true;
            }
        }
        
        // General knowledge / non-CPSU specific
        $generalKnowledge = [
            '/\b(who is the president of (usa|america|philippines|france|uk|russia|china|japan|korea|canada|mexico|germany|italy|spain))\b/i',
            '/\b(who (won|invented|discovered|created))\b/i',
            '/\b(what is the (capital|population|currency|language|religion|climate|weather)) of\b/i',
            '/\b(how (tall|heavy|fast|big|small|far|high|low) is\b)/i',
            '/\b(what (time|day|date|year|month) (is|was|will))\b/i',
            '/\b(translate|translation|meaning of|definition of)\b/i',
            '/\b(stock market|bitcoin|cryptocurrency|investing|trading|forex)\b/i',
        ];
        
        foreach ($generalKnowledge as $pattern) {
            if (preg_match($pattern, $m)) {
                return true;
            }
        }
        
        return false;
    }

    private function searchArticles(string $message, array $articles, int $max = 5): array
    {
        $keywords = $this->extractKeywords($message);
        
        // If no meaningful keywords after filtering stop words, return empty (no matches)
        if (empty($keywords)) {
            return [];
        }
        
        $phrase = implode(' ', $keywords);
        $results = [];
        
        foreach ($articles as $article) {
            $title = mb_strtolower($article['title'] ?? '');
            $content = mb_strtolower($article['content'] ?? '');
            $full = $title . ' ' . $content;
            $score = 0;
            
            foreach ($keywords as $kw) {
                if ($kw === '') continue;
                
                // Exact word match in title (high value)
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/iu', $title)) {
                    $score += 35;
                } elseif (str_contains($title, $kw)) {
                    $score += 15;
                }
                
                // Exact word match in content
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/iu', $content)) {
                    $score += 10;
                } elseif (str_contains($content, $kw)) {
                    $score += 3;
                }
            }
            
            // Phrase boost (only if phrase exists in title or content)
            if ($phrase !== '' && str_contains($title, $phrase)) {
                $score += 50;
            } elseif ($phrase !== '' && str_contains($full, $phrase)) {
                $score += 15;
            }
            
            // President query boost (only if relevant)
            if ($this->isPresidentQuery($message) && $score > 0) {
                $score += $this->presidentSignalScore($message, $article);
            }
            
            // Recency boost (only if already has some relevance)
            if ($score > 10) {
                $score += $this->recencyBoost((int) ($article['timestamp'] ?? 0));
            }
            
            // CRITICAL: Minimum threshold - don't include weak matches
            if ($score >= 25) {
                $article['_score'] = $score;
                $results[] = $article;
            }
        }
        
        usort($results, fn($a, $b) => ($b['_score'] ?? 0) <=> ($a['_score'] ?? 0));
        
        return array_slice($results, 0, $max);
    }

    /**
     * Improved system prompt → forces clean, readable Markdown output
     * This is the main fix for "hard to read" responses.
     */
    private function askModel(string $message, array $history, array $matchedArticles): ?string
    {
        $knowledge = $this->focusedKnowledge($matchedArticles);

        $systemPrompt = "You are Kaloy, the official AI chatbot of CPSU.\n\n" .
            "You must answer users in a professional, conversational, and intelligent way using ONLY the official CPSU content provided in the retrieved context.\n\n" .
            "Rules:\n" .
            "- Only use the retrieved CPSU content, database records, FAQs, policies, announcements, and official documents supplied at runtime.\n" .
            "- Do not use general knowledge or outside information.\n" .
            "- Do not guess, assume, or invent details.\n" .
            "- If the answer is partially supported, answer only the supported part and clearly say what is missing.\n" .
            "- If the answer is not found, reply exactly: \"I'm sorry, but I can only answer based on official CPSU content I have access to, and I don't see that information here yet.\"\n\n" .

            "STYLE - MAKE EVERY RESPONSE EASY TO READ:\n" .
            "- Use Markdown for maximum readability.\n" .
            "- Break text into short paragraphs with a blank line between them.\n" .
            "- Use **bold** for important names, terms, or numbers.\n" .
            "- Use bullet points (-) for lists.\n" .
            "- Use [Article Title](URL) format for any CPSU links.\n" .
            "- Never output one giant paragraph.\n" .
            "- Be friendly, respectful, and helpful to students, faculty, staff, and visitors.\n" .
            "- End with a helpful note when appropriate (e.g., \"You can read the full article here…\").\n\n" .

            "Retrieved context:\n" .
            "{$knowledge}\n\n" .
            "User message:\n" .
            "{$message}";

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt],
        ];

        foreach ($this->sanitizeHistory($history) as $item) {
            $messages[] = $item;
        }

        $messages[] = ['role' => 'user', 'content' => $message];

        try {
            $response = Http::timeout((int) env('OLLAMA_TIMEOUT', 12))
                ->connectTimeout((int) env('OLLAMA_CONNECT_TIMEOUT', 3))
                ->post(rtrim(env('OLLAMA_CHAT_URL', 'http://127.0.0.1:11434/api/chat'), '/'), [
                    'model' => env('OLLAMA_MODEL', 'llama3:8b'),
                    'messages' => $messages,
                    'stream' => false,
                    'options' => [
                        'temperature' => (float) env('OLLAMA_TEMPERATURE', 0.1),
                        'num_ctx' => (int) env('OLLAMA_NUM_CTX', 2048),
                        'top_p' => (float) env('OLLAMA_TOP_P', 0.9),
                        'repeat_penalty' => (float) env('OLLAMA_REPEAT_PENALTY', 1.08),
                    ]
                ]);

            if ($response->failed()) {
                Log::warning('Ollama HTTP error', ['status' => $response->status()]);
                return null;
            }

            $reply = trim((string) data_get($response->json(), 'message.content', ''));
            if (!$this->isAcceptableGroundedReply($reply)) {
                return null;
            }

            $reply = $this->cleanupReply($reply);           // now preserves Markdown
            return $this->injectArticleLinks($reply, $matchedArticles);
        } catch (\Throwable $e) {
            Log::error('Ollama exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    private function focusedKnowledge(array $matchedArticles): string
    {
        $parts = [];
        foreach (array_slice($matchedArticles, 0, 3) as $i => $article) {
            $parts[] = "[" . ($i + 1) . "]\n" .
                       "Type: " . ($article['type'] ?? 'content') . "\n" .
                       "Title: {$article['title']}\n" .
                       "Date: {$article['created_at']}\n" .
                       "URL: {$article['url']}\n" .
                       "Content: {$article['content']}";
        }
        return implode("\n\n---\n\n", $parts);
    }

    private function sanitizeHistory(array $history): array
    {
        $clean = [];
        foreach (array_slice($history, -self::MAX_HISTORY) as $item) {
            if (!is_array($item)) continue;

            $role = $item['role'] ?? null;
            $content = trim((string) ($item['content'] ?? ''));

            if (!in_array($role, ['user', 'assistant'], true) || $content === '') {
                continue;
            }

            $clean[] = [
                'role' => $role,
                'content' => mb_substr($content, 0, 500),
            ];
        }
        return $clean;
    }

    private function answerPresidentQuery(string $message, array $articles): ?string
    {
        $aliases = $this->institutionAliases($message) ?: ['CPSU', 'Central Philippines State University'];

        foreach ($articles as $article) {
            $name = $this->extractPresidentName($article, $aliases);
            if ($name) {
                return "Based on the official CPSU content **[{$article['title']}]({$article['url']})**, the president is **{$name}**.";
            }
        }
        return null;
    }

    private function presidentSignalScore(string $message, array $article): int
    {
        $full = $this->normalize(($article['title'] ?? '') . ' ' . ($article['content'] ?? ''));
        $lower = mb_strtolower($full);
        $aliases = $this->institutionAliases($message) ?: ['cpsu', 'central philippines state university'];
        $score = 0;

        foreach ($aliases as $alias) {
            $a = mb_strtolower($alias);
            if (str_contains($lower, $a)) $score += 4;

            foreach ([
                '/\b' . preg_quote($a, '/') . '\s+president\b/iu',
                '/\bpresident\s+of\s+' . preg_quote($a, '/') . '\b/iu',
            ] as $pattern) {
                if (preg_match($pattern, $lower)) $score += 12;
            }
        }
        return $score;
    }

    private function extractPresidentName(array $article, array $aliases): ?string
    {
        $text = $this->normalize(($article['title'] ?? '') . ' ' . ($article['content'] ?? ''));
        if ($text === '') return null;

        $name = '([A-Z][A-Za-z.\-\'`]+(?:\s+[A-Z][A-Za-z.\-\'`]+){0,5})';

        foreach ($aliases as $alias) {
            $a = preg_quote($alias, '/');
            $patterns = [
                '/\b' . $a . '\s+President\s*,?\s*(?:Dr\.|Engr\.|Atty\.|Mr\.|Mrs\.|Ms\.)?\s*' . $name . '/u',
                '/\bPresident\s+of\s+' . $a . '\s*,?\s*(?:Dr\.|Engr\.|Atty\.|Mr\.|Mrs\.|Ms\.)?\s*' . $name . '/u',
                '/(?:Dr\.|Engr\.|Atty\.|Mr\.|Mrs\.|Ms\.)?\s*' . $name . '\s*,\s*' . $a . '\s+President\b/u',
                '/(?:Dr\.|Engr\.|Atty\.|Mr\.|Mrs\.|Ms\.)?\s*' . $name . '\s*,\s*President\s+of\s+' . $a . '\b/u',
            ];

            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $text, $m)) {
                    $candidate = $this->cleanPersonName($m[1] ?? '');
                    if ($this->isValidPersonName($candidate)) {
                        return $candidate;
                    }
                }
            }
        }
        return null;
    }

    private function institutionAliases(string $message): array
    {
        $m = mb_strtolower($this->normalize($message));
        $aliases = [];
        $map = [
            'cpsu' => ['CPSU', 'Central Philippines State University'],
            'central philippines state university' => ['CPSU', 'Central Philippines State University'],
            'hccci' => ['HCCCI'],
            'nhsafi' => ['NHSAFI'],
        ];

        foreach ($map as $needle => $values) {
            if (str_contains($m, $needle)) {
                $aliases = array_merge($aliases, $values);
            }
        }
        return array_values(array_unique($aliases));
    }

    private function buildExtractiveFallback(string $message, array $articles): string
    {
        if (empty($articles)) return $this->noInfo;

        $top = $articles[0];
        $sentence = $this->bestSentence($message, (string) ($top['content'] ?? ''));

        if ($sentence === '') {
            return "I found relevant official CPSU content: **[{$top['title']}]({$top['url']})**.\n\nYou can open it for more details.";
        }

        if (preg_match('/\b(summarize|summary)\b/i', $message)) {
            return "Here's a quick summary from **[{$top['title']}]({$top['url']})**:\n\n{$sentence}";
        }

        return "{$sentence}\n\nYou can read more in **[{$top['title']}]({$top['url']})**.";
    }

    private function bestSentence(string $message, string $content): string
    {
        if ($content === '' || $content === 'Content not available.') return '';

        $keywords = $this->extractKeywords($message);
        $sentences = preg_split('/(?<=[.!?])\s+/u', $content) ?: [];
        $best = '';
        $bestScore = 0;

        foreach ($sentences as $sentence) {
            $sentence = trim($sentence);
            if (mb_strlen($sentence) < 25) continue;

            $lower = mb_strtolower($sentence);
            $score = 0;

            foreach ($keywords as $kw) {
                if (str_contains($lower, $kw)) $score += 2;
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/iu', $lower)) $score += 1;
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $sentence;
            }
        }

        if ($best === '' && !empty($sentences)) {
            $best = trim($sentences[0]);
        }

        return $best !== '' ? rtrim($best, ". \t\n\r\0\x0B") . '.' : '';
    }

    private function formatArticleList(array $articles, string $intro): string
    {
        $reply = $intro . "\n\n";
        foreach ($articles as $article) {
            $reply .= "- **[{$article['title']}]({$article['url']})**\n";
        }
        $reply .= "\nOpen any item to read more.";
        return $reply;
    }

    private function isAcceptableGroundedReply(string $reply): bool
    {
        if ($reply === '') return false;

        $lower = mb_strtolower($reply);
        foreach (['maybe','i think','possibly','probably','it seems','not sure','i am not sure','based on general knowledge','as an ai'] as $bad) {
            if (str_contains($lower, $bad)) return false;
        }
        return true;
    }

    /**
     * FIXED: Now preserves Markdown formatting and newlines
     * This was the #1 reason responses were hard to read before.
     */
    private function cleanupReply(string $reply): string
    {
        $reply = trim($reply);

        // Collapse only horizontal whitespace (spaces/tabs), KEEP newlines
        $reply = preg_replace('/[ \t]+/u', ' ', $reply);

        // Normalize excessive newlines (max 2 blank lines)
        $reply = preg_replace('/\n{3,}/u', "\n\n", $reply);

        return $reply;
    }

    private function injectArticleLinks(string $text, array $articles): string
    {
        // Sort longest titles first to avoid partial matches
        usort($articles, fn($a, $b) => mb_strlen($b['title'] ?? '') <=> mb_strlen($a['title'] ?? ''));

        foreach ($articles as $article) {
            $title = trim((string) ($article['title'] ?? ''));
            $url = trim((string) ($article['url'] ?? ''));

            if ($title === '' || $url === '' || $url === '#') continue;

            $escaped = preg_quote($title, '/');
            $text = preg_replace(
                "/(?<!\[)({$escaped})(?!\]\()/iu",
                "[{$title}]({$url})",
                $text
            );
        }

        return $text;
    }

    private function normalize(string $text): string
    {
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);
        $text = trim($text);

        if (class_exists('\Normalizer')) {
            $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
        }

        return $text;
    }

    private function extractKeywords(string $message): array
    {
        $message = $this->normalize(mb_strtolower($message));
        $message = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $message);
        $words = preg_split('/\s+/u', $message) ?: [];

        $keywords = array_filter($words, fn($word) => mb_strlen($word) > 2 && !in_array($word, $this->stopWords, true));

        return array_values(array_unique($keywords));
    }

    private function recencyBoost(int $timestamp): int
    {
        if ($timestamp <= 0) return 0;

        $daysOld = (int) floor((time() - $timestamp) / 86400);

        return match (true) {
            $daysOld <= 7   => 4,
            $daysOld <= 30  => 3,
            $daysOld <= 90  => 2,
            $daysOld <= 180 => 1,
            default         => 0,
        };
    }

    private function cleanPersonName(string $name): string
    {
        $name = trim($name);
        $name = preg_replace('/\s+/u', ' ', $name);
        $name = preg_replace('/^(Dr\.|Engr\.|Atty\.|Mr\.|Mrs\.|Ms\.)\s+/u', '', $name);
        return trim($name, " \t\n\r\0\x0B,.;:-");
    }

    private function isValidPersonName(string $name): bool
    {
        if ($name === '' || mb_strlen($name) < 5 || mb_strlen($name) > 80) return false;

        $parts = preg_split('/\s+/u', $name) ?: [];
        if (count($parts) < 2) return false;

        foreach ($parts as $part) {
            if (!preg_match('/^[A-Z][A-Za-z.\-\'`]+$/u', $part)) return false;
        }

        foreach (['President', 'CPSU', 'HCCCI', 'NHSAFI', 'Campus', 'Partnership', 'University', 'College'] as $bad) {
            if (stripos($name, $bad) !== false) return false;
        }

        return true;
    }

    /**
     * New helper: returns clean sources array for the JSON response
     */
    private function prepareSources(array $articles): array
    {
        return array_map(fn($article) => [
            'id'    => $article['id'] ?? '',
            'type'  => $article['type'] ?? 'content',
            'title' => $article['title'] ?? '',
            'url'   => $article['url'] ?? '#',
            'date'  => $article['created_at'] ?? null,
        ], $articles);
    }
}
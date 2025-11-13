<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function chatbotData()
    {
        // Include created_at and updated_at columns
        $articles = Article::latest()->get(['id', 'title', 'content', 'created_at', 'updated_at']);

        $data = $articles->map(function ($article) {
            $contentPath = public_path("Uploads/News/content/{$article->content}");
            $contentText = 'Content not available';

            if (!empty($article->content) && File::exists($contentPath)) {
                $rawContent = File::get($contentPath);

                // Keep simple text only, remove HTML tags
                $cleanText = strip_tags($rawContent);
                $cleanText = preg_replace('/\s+/', ' ', $cleanText); // normalize spaces

                // Limit content length (optional)
                $contentText = mb_substr($cleanText, 0, 500) . (strlen($cleanText) > 500 ? '...' : '');
            }

            // Clean up the title
            $title = strip_tags($article->title);
            if (class_exists('\Normalizer')) {
                $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $title = transliterator_transliterate('NFKC', $title);
            }
            $title = preg_replace('/\p{Cf}/u', '', $title);

            return [
                'title' => $title,
                'content' => $contentText,
                'url' => route('view-article', ['id' => $article->id]),
                'created_at' => $article->created_at->toDateTimeString(),
                'updated_at' => $article->updated_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'source' => 'CPSU Website - Articles',
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}

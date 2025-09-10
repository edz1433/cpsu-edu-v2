<?php

namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Submenu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function newsList()
    {
        $article = Article::latest()->paginate(10);

        $article->transform(function ($art) {
            // Format date
            $art->date = $art->created_at->format('M d, Y');

            // Safe title
            $title = strip_tags($art->title);
            if (class_exists('\Normalizer')) { // use global namespace
                $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $title = transliterator_transliterate('NFKC', $title);
            }
            $art->safe_title = preg_replace('/\p{Cf}/u', '', $title);

            // Thumbnail image
            $art->image = !empty($art->thumbnail) 
                ? asset("Uploads/News/thumbnail/{$art->thumbnail}") 
                : asset("Uploads/default-thumbnail.png");

            // Excerpt
            $art->excerpt = 'Content not available';
            if (!empty($art->content)) {
                $contentPath = public_path("Uploads/News/content/{$art->content}");
                if (file_exists($contentPath)) {
                    $text = strip_tags(file_get_contents($contentPath));

                    if (class_exists('\Normalizer')) {
                        $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
                    } elseif (function_exists('transliterator_transliterate')) {
                        $text = transliterator_transliterate('NFKC', $text);
                    }
                    $text = preg_replace('/\p{Cf}/u', '', $text);

                    $words = preg_split('/\s+/', $text);
                    $maxWords = 25;

                    if (count($words) > $maxWords) {
                        $art->excerpt = implode(' ', array_slice($words, 0, $maxWords)) ;
                    } else {
                        $art->excerpt = $text;
                    }
                }
            }

            return $art;
        });

        return response()->json($article);
    }

    public function menuPreview($id)
    {
        $item = Submenu::find($id);

        if (!$item) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        // ========== DATE ==========
        $item->date = $item->created_at->format('M d, Y');

        // ========== SAFE TITLE ==========
        $title = strip_tags($item->title);
        if (class_exists('\Normalizer')) {
            $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
        } elseif (function_exists('transliterator_transliterate')) {
            $title = transliterator_transliterate('NFKC', $title);
        }
        $item->safe_title = preg_replace('/\p{Cf}/u', '', $title);

        // ========== CONTENT ==========
        $contentPath = public_path("Uploads/Submenu/content/{$item->content}");
        if (!empty($item->content) && File::exists($contentPath)) {
            $rawContent = File::get($contentPath);

            if (class_exists('\Normalizer')) {
                $rawContent = \Normalizer::normalize($rawContent, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $rawContent = transliterator_transliterate('NFKC', $rawContent);
            }
            $rawContent = preg_replace('/\p{Cf}/u', '', $rawContent);

            $item->content_text = $rawContent;

            $words = preg_split('/\s+/', strip_tags($rawContent));
            $maxWords = 25;
            $item->excerpt = count($words) > $maxWords
                ? implode(' ', array_slice($words, 0, $maxWords)) . '...'
                : strip_tags($rawContent);
        } else {
            $item->content_text = 'Content not available';
            $item->excerpt = 'Content not available';
        }

        // ========== THUMBNAIL ==========
        if (!empty($item->thumbnail)) {
            $thumbnailPath = public_path("Uploads/Submenu/thumbnail/{$item->thumbnail}");
            if (File::exists($thumbnailPath)) {
                $base64 = base64_encode(File::get($thumbnailPath));
                $mime = File::mimeType($thumbnailPath);
                $item->thumbnail_base64 = "data:{$mime};base64,{$base64}";
            } else {
                $item->thumbnail_base64 = null;
            }
        } else {
            $item->thumbnail_base64 = null;
        }

        // ========== MULTIPLE IMAGES ==========
        $imageFiles = array_filter(explode(',', $item->images ?? ''));
        $base64Images = [];
        foreach ($imageFiles as $imageName) {
            $imagePath = public_path("Uploads/Submenu/images/{$imageName}");
            if (File::exists($imagePath)) {
                $base64 = base64_encode(File::get($imagePath));
                $mime = File::mimeType($imagePath);
                $base64Images[] = "data:{$mime};base64,{$base64}";
            }
        }
        $item->images_base64 = $base64Images;

        return response()->json($item);
    }

    public function relatedNews(Request $request)
    {
        $articleId = $request->input('exclude_id'); // current article ID
        $title = $request->input('title');          // current article title
        $content = $request->input('content');      // current article content

        if (!$articleId || (!$title && !$content)) {
            return response()->json([], 400);
        }

        // Combine title + content of current article as the "query"
        $queryText = trim(($title ?? '') . ' ' . ($content ?? ''));
        $words = preg_split('/\s+/', strip_tags($queryText), -1, PREG_SPLIT_NO_EMPTY);
        $words = array_map('strtolower', $words);

        if (empty($words)) {
            return response()->json([], 200);
        }

        $articles = Article::where('id', '!=', $articleId)->get();

        // Calculate a simple relevance score
        $articles = $articles->map(function ($art) use ($words) {
            $artText = strtolower(strip_tags(($art->title ?? '') . ' ' . ($art->content ?? '')));
            $score = 0;
            foreach ($words as $word) {
                $score += substr_count($artText, $word); // simple frequency match
            }
            $art->relevance = $score;
            return $art;
        })
        ->filter(fn($art) => $art->relevance > 0) // remove zero matches
        ->sortByDesc('relevance')                 // sort by highest relevance
        ->take(3);                                // only top 3

        // Transform articles
        $articles->transform(function ($art) {
            $art->date = $art->created_at ? $art->created_at->format('M d, Y') : null;

            $cleanTitle = strip_tags($art->title ?? '');
            if (class_exists('\Normalizer')) {
                $cleanTitle = \Normalizer::normalize($cleanTitle, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $cleanTitle = transliterator_transliterate('NFKC', $cleanTitle);
            }
            $art->safe_title = preg_replace('/\p{Cf}/u', '', $cleanTitle);

            $art->image = !empty($art->thumbnail)
                ? asset("Uploads/News/thumbnail/{$art->thumbnail}")
                : asset("Uploads/default-thumbnail.png");

            $art->excerpt = 'Content not available';
            if (!empty($art->content)) {
                $contentPath = public_path("Uploads/News/content/{$art->content}");
                if (file_exists($contentPath)) {
                    $text = strip_tags(file_get_contents($contentPath));

                    if (class_exists('\Normalizer')) {
                        $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
                    } elseif (function_exists('transliterator_transliterate')) {
                        $text = transliterator_transliterate('NFKC', $text);
                    }
                    $text = preg_replace('/\p{Cf}/u', '', $text);

                    $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
                    $maxWords = 25;

                    $art->excerpt = count($words) > $maxWords
                        ? implode(' ', array_slice($words, 0, $maxWords)) : $text;
                }
            }

            return $art;
        });

        return response()->json($articles->values()); // reset keys
    }

    public function newsPreview(Request $request)
    {
        $article = Article::find($request->id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        // ========== DATE ==========
        $article->date = $article->created_at->format('M d, Y');

        // ========== SAFE TITLE ==========
        $title = strip_tags($article->title);
        if (class_exists('\Normalizer')) {
            $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
        } elseif (function_exists('transliterator_transliterate')) {
            $title = transliterator_transliterate('NFKC', $title);
        }
        $article->safe_title = preg_replace('/\p{Cf}/u', '', $title);

        // ========== CONTENT ==========
        $contentPath = public_path("Uploads/News/content/{$article->content}");
        if (!empty($article->content) && File::exists($contentPath)) {
            $rawContent = File::get($contentPath);

            // Strip all tags except <br>, <b>, and <span>
            $allowedContent = strip_tags($rawContent, '<br><b><span>');

            // Clean span, only allow inline color style
            $article->content_text = preg_replace_callback(
                '/<span[^>]*>/i',
                function ($matches) {
                    if (preg_match('/style\s*=\s*"(.*?)"/i', $matches[0], $styleMatch)) {
                        $style = $styleMatch[1];
                        if (preg_match('/color\s*:\s*[^;]+/i', $style)) {
                            return '<span style="' . $style . '">';
                        }
                    }
                    return '<span>';
                },
                $allowedContent
            );
        } else {
            $article->content_text = 'Content not available';
        }

        // ========== THUMBNAIL ==========
        if (!empty($article->thumbnail)) {
            $thumbnailPath = public_path("Uploads/News/thumbnail/{$article->thumbnail}");
            if (File::exists($thumbnailPath)) {
                $base64 = base64_encode(File::get($thumbnailPath));
                $mime = File::mimeType($thumbnailPath);
                $article->thumbnail_base64 = "data:{$mime};base64,{$base64}";
            } else {
                $article->thumbnail_base64 = null;
            }
        } else {
            $article->thumbnail_base64 = null;
        }

        // Add absolute path fallback for image
        $article->image = !empty($article->thumbnail) 
            ? asset("Uploads/News/thumbnail/{$article->thumbnail}") 
            : asset("Uploads/News/default-thumbnail.png");

        // ========== MULTIPLE IMAGES ==========
        $imageFiles = array_filter(explode(',', $article->images ?? ''));
        $base64Images = [];

        foreach ($imageFiles as $imageName) {
            $imagePath = public_path("Uploads/News/images/{$imageName}");
            if (File::exists($imagePath)) {
                $base64 = base64_encode(File::get($imagePath));
                $mime = File::mimeType($imagePath);
                $base64Images[] = "data:{$mime};base64,{$base64}";
            }
        }

        $article->images_base64 = $base64Images;

        // ========== EXCERPT ==========
        $article->excerpt = 'Content not available';
        if (!empty($article->content) && File::exists($contentPath)) {
            $text = strip_tags(File::get($contentPath));

            if (class_exists('\Normalizer')) {
                $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $text = transliterator_transliterate('NFKC', $text);
            }
            $text = preg_replace('/\p{Cf}/u', '', $text);

            $words = preg_split('/\s+/', $text);
            $maxWords = 25;

            if (count($words) > $maxWords) {
                $article->excerpt = implode(' ', array_slice($words, 0, $maxWords)) . '...';
            } else {
                $article->excerpt = $text;
            }
        }

        return response()->json($article);
    }



}
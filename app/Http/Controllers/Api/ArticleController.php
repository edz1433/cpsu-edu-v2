<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get()->map(function ($art) {
            // Load content text
            $contentPath = public_path("Uploads/News/content/{$art->content}");
            $art->content_text = File::exists($contentPath)
                ? File::get($contentPath)
                : 'Content not available';

            // Get full path to thumbnail
            $thumbnailPath = public_path("Uploads/News/thumbnail/{$art->thumbnail}");

            // Create base64 thumbnail if exists
            if (File::exists($thumbnailPath)) {
                $base64 = base64_encode(File::get($thumbnailPath));
                $mime = File::mimeType($thumbnailPath);
                $art->thumbnail_base64 = "data:{$mime};base64,{$base64}";
            } else {
                $art->thumbnail_base64 = null;
            }

            // Optional: still include URL version if needed
            $art->thumbnail_url = asset("Uploads/News/thumbnail/{$art->thumbnail}");

            return $art;
        });

        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        // Allow <br> in title only
        $article->title = strip_tags($article->title, '<br>');

        // Load and sanitize content
        $contentPath = public_path("Uploads/News/content/{$article->content}");
        if (File::exists($contentPath)) {
            $rawContent = File::get($contentPath);

            // Strip all tags except <br>, <b>, and <span>
            $allowedContent = strip_tags($rawContent, '<br><b><span>');

            // Optional: use regex to clean <span> and only allow inline color styles
            $article->content_text = preg_replace_callback(
                '/<span[^>]*>/i',
                function ($matches) {
                    // Allow only style="color:..." attribute
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

        // Base64 encode the main thumbnail
        $thumbnailPath = public_path("Uploads/News/thumbnail/{$article->thumbnail}");
        if (File::exists($thumbnailPath)) {
            $base64 = base64_encode(File::get($thumbnailPath));
            $mime = File::mimeType($thumbnailPath);
            $article->thumbnail_base64 = "data:{$mime};base64,{$base64}";
        } else {
            $article->thumbnail_base64 = null;
        }

        // Handle multiple base64 images
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

        return response()->json($article);
    }


}
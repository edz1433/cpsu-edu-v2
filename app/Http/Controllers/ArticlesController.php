<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    
    public function createArticles(){
        return view('webadmin.articles-create');
    }

    public function storeArticles(Request $request)
    {
        $validatedData = $request->validate([
            'title'     => 'required|string',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'images.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $rand = rand(1000, 9999);
        $timestamp = now()->format('YmdHis');
        $randomFilename = "News-{$timestamp}-{$rand}.txt";

        // ✅ Save content file directly inside public/Uploads/News/content
        $contentDir = public_path("Uploads/News/content");
        if (!file_exists($contentDir)) {
            mkdir($contentDir, 0777, true);
        }
        file_put_contents("{$contentDir}/{$randomFilename}", $validatedData['content']);

        // ✅ Handle thumbnail
        $newFileName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();

            $thumbDir = public_path("Uploads/News/thumbnail");
            if (!file_exists($thumbDir)) {
                mkdir($thumbDir, 0777, true);
            }
            $file->move($thumbDir, $newFileName);
        }

        // ✅ Handle multiple images and rename using thumbnail as base
        $imageNames = [];
        if ($request->hasFile('images')) {
            $index = 1;
            $imageDir = public_path("Uploads/News/images");
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $baseName = $newFileName ? pathinfo($newFileName, PATHINFO_FILENAME) : "news-{$timestamp}-{$rand}";
                $imageName = "{$baseName}-{$index}.{$ext}";

                $image->move($imageDir, $imageName);
                $imageNames[] = $imageName;
                $index++;
            }
        }

        // ✅ Save DB record
        $article = new Article([
            'title'     => $validatedData['title'],
            'content'   => $randomFilename,
            'thumbnail' => $newFileName,
            'images'    => implode(',', $imageNames), // store as comma-separated string
        ]);

        $article->save();

        return redirect()->back()->with('success', 'Article created successfully');
    }

    public function updateArticles(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'News not found.');
        }

        $validatedData = $request->validate([
            'title'     => 'required|string',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'images.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'created_at' => 'nullable|date',
        ]);

        $timestamp = now()->format('YmdHis');
        $rand = rand(1000, 9999);

        // ✅ Update title
        $article->title = $validatedData['title'];

        // ✅ Update created_at (if provided)
        if (!empty($validatedData['created_at'])) {
            $article->created_at = $validatedData['created_at'];
        }

        // ✅ Update content (overwrite existing .txt file)
        if ($article->content) {
            $contentFilePath = public_path("Uploads/News/content/{$article->content}");
        } else {
            $article->content = "News-{$timestamp}-{$rand}.txt";
            $contentFilePath = public_path("Uploads/News/content/{$article->content}");
        }

        $contentDir = dirname($contentFilePath);
        if (!file_exists($contentDir)) {
            mkdir($contentDir, 0777, true);
        }
        file_put_contents($contentFilePath, $validatedData['content']);

        // ✅ Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = "thumbnail-{$timestamp}-{$rand}." . $file->getClientOriginalExtension();
            $thumbDir = public_path("Uploads/News/thumbnail");

            if (!file_exists($thumbDir)) {
                mkdir($thumbDir, 0777, true);
            }
            $file->move($thumbDir, $newFileName);

            // Delete old thumbnail
            if ($article->thumbnail) {
                $oldPath = public_path("Uploads/News/thumbnail/{$article->thumbnail}");
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $article->thumbnail = $newFileName;
        }

        // ✅ Handle images
        if ($request->hasFile('images')) {
            // Delete old images
            if (!empty($article->images)) {
                foreach (explode(',', $article->images) as $oldImg) {
                    $oldPath = public_path("Uploads/News/images/" . trim($oldImg));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            $imageDir = public_path("Uploads/News/images");
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            $imageNames = [];
            $index = 1;
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $baseName = $article->thumbnail
                    ? pathinfo($article->thumbnail, PATHINFO_FILENAME)
                    : "news-{$timestamp}-{$rand}";
                $imageName = "{$baseName}-{$index}.{$ext}";

                $image->move($imageDir, $imageName);
                $imageNames[] = $imageName;
                $index++;
            }

            $article->images = implode(',', $imageNames);
        }

        $article->save();

        return redirect()->back()->with('success', 'News updated successfully');
    }

    public function editArticles($id){
        $article = Article::find($id);
        return view('webadmin.articles-edit', compact('article'));
    }

    public function articleContent($id){
        $article = Article::find($id);
        return view('webadmin.article-content', compact('article'));
    }

}

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

        // ✅ Save content to storage/app/public/Uploads/News/content
        $contentFilePath = "Uploads/News/content/{$randomFilename}";
        Storage::disk('public')->put($contentFilePath, $validatedData['content']);

        // ✅ Handle thumbnail
        $newFileName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("Uploads/News/thumbnail", $file, $newFileName);
        }

        // ✅ Handle multiple images and rename using thumbnail as base
        $imageNames = [];
        if ($request->hasFile('images')) {
            $index = 1;
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $baseName = $newFileName ? pathinfo($newFileName, PATHINFO_FILENAME) : "news-{$timestamp}-{$rand}";
                $imageName = "{$baseName}-{$index}.{$ext}";
                Storage::disk('public')->putFileAs("Uploads/News/images", $image, $imageName);
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
            'title' => 'required|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable',
            'images.*' => 'nullable',
        ]);

        $article->title = $validatedData['title'];

        // Update content in .txt file
        if ($article->content) {
            $contentFilePath = "Uploads/News/content/{$article->content}";
            $fullContentFilePath = public_path($contentFilePath);
            file_put_contents($fullContentFilePath, $validatedData['content']);
        }

        $timestamp = now()->format('YmdHis');
        $rand = rand(1000, 9999);

        // Handle new thumbnail if uploaded
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            $customPath = 'Uploads/News/thumbnail/';
            $file->move(public_path($customPath), $newFileName);

            // Delete old thumbnail if exists
            if ($article->thumbnail) {
                $oldThumbnailPath = public_path($customPath . $article->thumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            $article->thumbnail = $newFileName;
        } else {
            // Base name for new images if no new thumbnail uploaded
            $newFileName = $article->thumbnail 
                ? pathinfo($article->thumbnail, PATHINFO_FILENAME)
                : 'news-' . $timestamp . '-' . $rand;
        }

        // Handle image upload and clear all old images
        if ($request->hasFile('images')) {
            // Delete all old images first
            if (!empty($article->images)) {
                foreach (explode(',', $article->images) as $oldImg) {
                    $oldPath = public_path('Uploads/News/images/' . trim($oldImg));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            // Save new images
            $imageNames = [];
            $index = 1;
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $baseName = pathinfo($newFileName, PATHINFO_FILENAME);
                $imageName = "{$baseName}-{$index}.{$ext}";
                $image->move(public_path('Uploads/News/images'), $imageName);
                $imageNames[] = $imageName;
                $index++;
            }

            $article->images = implode(',', $imageNames);
        } else {
            // If no new images uploaded, delete all existing ones and set to null
            if (!empty($article->images)) {
                foreach (explode(',', $article->images) as $oldImg) {
                    $oldPath = public_path('Uploads/News/images/' . trim($oldImg));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }
            $article->images = null;
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

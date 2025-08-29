<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Submenu;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubmenuController extends Controller
{
    public function createSubmenu (){
        $category = Category::all();
        $subcategories = SubCategory::all();
        return view('webadmin.submenu-create', compact('category', 'subcategories'));
    }

    public function storeSubmenu(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string',
            'category'    => 'required|string',
            'subcategory' => 'nullable|string',
            'url'         => 'nullable|string',
            'men_order'   => 'required|integer',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|file',
            'status'      => 'required|integer',
        ]);

        $rand = rand(1000, 9999);
        $timestamp = now()->format('YmdHis');
        $categorySlug = \Str::slug($validatedData['category'], '-');

        // --- Content File ---
        $contentFilename = "{$categorySlug}-{$timestamp}-{$rand}.txt";
        $contentPath = public_path("Uploads/Submenu/content/{$contentFilename}");

        // Make sure the content directory exists
        if (!file_exists(dirname($contentPath))) {
            mkdir(dirname($contentPath), 0777, true);
        }

        // Save content directly into public/Uploads/Submenu/content
        if (file_put_contents($contentPath, $validatedData['content']) === false) {
            return redirect()->back()->with('error', 'Failed to save content file.');
        }

        $thumbnailFilename = null;

        // --- Thumbnail File ---
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailFilename = "thumbnail-{$timestamp}-{$rand}." . $file->getClientOriginalExtension();
            $thumbnailPath = public_path("Uploads/Submenu/thumbnail");

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0777, true);
            }

            if (!$file->move($thumbnailPath, $thumbnailFilename)) {
                return redirect()->back()->with('error', 'Failed to save thumbnail.');
            }
        }

        // --- Save to Database ---
        Submenu::create([
            'title'       => $validatedData['title'],
            'category'    => $validatedData['category'],
            'subcategory' => $validatedData['subcategory'],
            'url'         => $validatedData['url'],
            'menu_order'  => $validatedData['men_order'],
            'content'     => $contentFilename,   // just the filename, not full path
            'thumbnail'   => $thumbnailFilename, // just the filename
            'status'      => $validatedData['status'],
        ]);

        return redirect()->back()->with('success', 'Submenu created successfully');
    }

    public function updateSubmenu(Request $request, $id)
    {
        $submenu = Submenu::find($id);

        if (!$submenu) {
            return redirect()->back()->with('error', 'Submenu not found.');
        }

        $validatedData = $request->validate([
            'title'       => 'required|string',
            'category'    => 'required|string',
            'subcategory' => 'nullable|string',
            'url'         => 'nullable|string',
            'men_order'   => 'required|integer',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status'      => 'required|integer',
        ]);

        $rand = rand(1000, 9999);
        $timestamp = now()->format('YmdHis');
        $categorySlug = \Str::slug($validatedData['category'], '-');

        // --- Always save new content file ---
        $newContentFilename = "{$categorySlug}-{$timestamp}-{$rand}.txt";
        $newContentPath = public_path("Uploads/Submenu/content/{$newContentFilename}");

        if (!file_exists(dirname($newContentPath))) {
            mkdir(dirname($newContentPath), 0777, true);
        }

        if (file_put_contents($newContentPath, $validatedData['content']) === false) {
            return redirect()->back()->with('error', 'Failed to save content file.');
        }

        // --- Remove old content file ---
        if ($submenu->content) {
            $oldContentPath = public_path("Uploads/Submenu/content/{$submenu->content}");
            if (file_exists($oldContentPath)) {
                unlink($oldContentPath);
            }
        }

        // --- Handle thumbnail ---
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newThumbnailFilename = "thumbnail-{$timestamp}-{$rand}." . $file->getClientOriginalExtension();
            $thumbnailPath = public_path("Uploads/Submenu/thumbnail");

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0777, true);
            }

            // Move new thumbnail
            $file->move($thumbnailPath, $newThumbnailFilename);

            // Remove old thumbnail if exists
            if ($submenu->thumbnail) {
                $oldThumbnailPath = public_path("Uploads/Submenu/thumbnail/{$submenu->thumbnail}");
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            $submenu->thumbnail = $newThumbnailFilename;
        }

        // --- Update database fields ---
        $submenu->title       = $validatedData['title'];
        $submenu->category    = $validatedData['category'];
        $submenu->subcategory = $validatedData['subcategory'] ?? NULL;
        $submenu->url         = $validatedData['url'];
        $submenu->menu_order  = $validatedData['men_order'];
        $submenu->status      = $validatedData['status'];
        $submenu->content     = $newContentFilename;

        $submenu->save();

        return redirect()->back()->with('success', 'Submenu updated successfully');
    }

    public function editSubmenu($id){
        $category = Category::all();
        $submenu = Submenu::query()
            ->leftJoin('sub_categories', 'sub_categories.id', '=', 'submenus.subcategory')
            ->where('submenus.id', $id)
            ->select('submenus.*', 'sub_categories.title as sub_category_title')
            ->first();

        $subcategories = SubCategory::all();
        return view('webadmin.submenu-edit', compact('category', 'submenu', 'subcategories'));
    }

    public function subContent($id){
        $submenu = Submenu::find($id);
        return view('webadmin.submenu-content', compact('submenu'));
    }

    public function subcategories($id)
    {
        $subcategories = Subcategory::where('categories_id', $id)->get(['id', 'title']);
        return response()->json($subcategories);
    }
}

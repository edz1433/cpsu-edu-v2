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
        $contentPath = "Uploads/Submenu/content/{$contentFilename}";

        // Make sure the content directory exists
        Storage::disk('public')->makeDirectory('Uploads/Submenu/content');

        // Save content to storage/app/public/Uploads/Submenu/content
        if (!Storage::disk('public')->put($contentPath, $validatedData['content'])) {
            return redirect()->back()->with('error', 'Failed to save content file.');
        }

        $thumbnailFilename = null;

        // --- Thumbnail File ---
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailFilename = "thumbnail-{$timestamp}-{$rand}." . $file->getClientOriginalExtension();
            Storage::disk('public')->makeDirectory('Uploads/Submenu/thumbnail');

            if (!Storage::disk('public')->putFileAs('Uploads/Submenu/thumbnail', $file, $thumbnailFilename)) {
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
            'content'     => $contentFilename,
            'thumbnail'   => $thumbnailFilename,
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
        $category = Str::slug($validatedData['category'], '-');

        // ✅ Always create/replace content file with new random filename
        $randomFilename = "{$category}-{$timestamp}-{$rand}.txt";
        $contentFilePath = "Uploads/Submenu/content/{$randomFilename}";

        Storage::disk('public')->put($contentFilePath, $validatedData['content']);

        // ✅ Remove old content file if exists
        if ($submenu->content) {
            $oldContentPath = "Uploads/Submenu/content/{$submenu->content}";
            if (Storage::disk('public')->exists($oldContentPath)) {
                Storage::disk('public')->delete($oldContentPath);
            }
        }

        // ✅ Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            $customPath = "Uploads/Submenu/thumbnail/{$newFileName}";

            Storage::disk('public')->putFileAs("Uploads/Submenu/thumbnail", $file, $newFileName);

            // Remove old thumbnail if exists
            if ($submenu->thumbnail) {
                $oldThumbnailPath = "Uploads/Submenu/thumbnail/{$submenu->thumbnail}";
                if (Storage::disk('public')->exists($oldThumbnailPath)) {
                    Storage::disk('public')->delete($oldThumbnailPath);
                }
            }

            $submenu->thumbnail = $newFileName;
        }

        // ✅ Update database fields
        $submenu->title       = $validatedData['title'];
        $submenu->category    = $validatedData['category'];
        $submenu->subcategory = $validatedData['subcategory'] ?? NULL;
        $submenu->url         = $validatedData['url'];
        $submenu->menu_order  = $validatedData['men_order'];
        $submenu->status      = $validatedData['status'];
        $submenu->content     = $randomFilename;

        $submenu->save();

        return redirect()->back()->with('success', 'Submenu updated successfully');
    }

    public function editSubmenu($id){
        $category = Category::all();
        $submenu = Submenu::find($id);
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

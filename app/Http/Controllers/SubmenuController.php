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
            'title' => 'required|string',
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'url' => 'nullable|string',
            'men_order' => 'required|integer',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|integer',
        ]);

        $rand = rand(1000, 9999);
        $timestamp = now()->format('YmdHis');

        $category = Str::slug($validatedData['category'], '-');
        $randomFilename = "{$category}-{$timestamp}-" . $rand . '.txt';

        $contentFilePath = "Uploads/Submenu/content/{$randomFilename}";
        $fullContentFilePath = public_path($contentFilePath);
        file_put_contents($contentFilePath, $validatedData['content']);

        $newFileName = null;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            $customPath = 'Uploads/Submenu/thumbnail/';
            
            $file->move(public_path($customPath), $newFileName);
        }

        $submenu = new Submenu([
            'title'       => $validatedData['title'],
            'category'    => $validatedData['category'],
            'subcategory' => $validatedData['subcategory'],
            'url'         => $validatedData['url'],
            'menu_order'  => $validatedData['men_order'],
            'content'     => $randomFilename,
            'thumbnail'   => $newFileName,
            'status'      => $validatedData['status'],
        ]);

        $submenu->save();

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

        // Always create/replace content file with new random filename
        $randomFilename = "{$category}-{$timestamp}-{$rand}.txt";
        $contentFilePath = "Uploads/Submenu/content/{$randomFilename}";
        $fullContentFilePath = public_path($contentFilePath);
        file_put_contents($fullContentFilePath, $validatedData['content']);

        // Remove old content file if exists
        if ($submenu->content) {
            $oldContentPath = public_path("Uploads/Submenu/content/{$submenu->content}");
            if (file_exists($oldContentPath)) {
                unlink($oldContentPath);
            }
        }

        // Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            $customPath = 'Uploads/Submenu/thumbnail/';

            $file->move(public_path($customPath), $newFileName);

            // Remove old thumbnail if exists
            if ($submenu->thumbnail) {
                $oldThumbnailPath = public_path($customPath . $submenu->thumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            $submenu->thumbnail = $newFileName;
        }

        // Update database fields
        $submenu->title       = $validatedData['title'];
        $submenu->category    = $validatedData['category'];
        $submenu->subcategory = $validatedData['subcategory'];
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

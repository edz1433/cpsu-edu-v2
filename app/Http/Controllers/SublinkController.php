<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Submenu;
use App\Models\Sublink;
use App\Models\Category;
use Illuminate\Support\Str;

class SublinkController extends Controller
{
    public function createSublink (){
        $category = Category::all();
        return view('webadmin.Sublink-create', compact('category'));
    }

    public function storeSublink(Request $request)
    {
        $validatedData = $request->validate([
            'title'     => 'required|string',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', 
        ]);

        $rand = rand(1000, 9999);
        $timestamp = now()->format('YmdHis');

        // ✅ Generate filename for content
        $randomFilename = "Sublink-{$timestamp}-{$rand}.txt";

        // ✅ Save content to storage/app/public/Uploads/Sublink/content
        $contentFilePath = "Uploads/Sublink/content/{$randomFilename}";
        Storage::disk('public')->put($contentFilePath, $validatedData['content']);

        // ✅ Handle thumbnail
        $newFileName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs("Uploads/Sublink/thumbnail", $file, $newFileName);
        }

        $sublink = new Sublink([
            'title'     => $validatedData['title'],
            'content'   => $randomFilename, // only filename
            'thumbnail' => $newFileName,    // only filename
        ]);

        $sublink->save();

        return redirect()->back()->with('success', 'Sublink created successfully');
    }

    public function updateSubLink(Request $request, $id)
    {
        $sublink = Sublink::find($id);
    
        if (!$sublink) {
            return redirect()->back()->with('error', 'Sublink not found.');
        }
    
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);
    
        $sublink->title = $validatedData['title'];
    
        if ($sublink->content) {
            $contentFilePath = "Uploads/Sublink/content/{$sublink->content}";
            $fullContentFilePath = public_path($contentFilePath);
            file_put_contents($fullContentFilePath, $validatedData['content']);
        }
    
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $timestamp = now()->format('YmdHis');
            $rand = rand(1000, 9999);
            $newFileName = 'thumbnail-' . $timestamp . '-' . $rand . '.' . $file->getClientOriginalExtension();
            $customPath = 'Uploads/Sublink/thumbnail/';
    
            $file->move(public_path($customPath), $newFileName);
    
            if ($sublink->thumbnail) {
                $oldThumbnailPath = public_path($customPath . $sublink->thumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
    
            $sublink->thumbnail = $newFileName;
        }
    
        $sublink->save();
    
        return redirect()->back()->with('success', 'Sublink updated successfully');
    }  

    public function editSublink($id){
        $sublink = Sublink::find($id);
        return view('webadmin.sublink-edit', compact('sublink'));
    }

    public function sublinkContent($id){
        $sublink = Sublink::find($id);
        return view('webadmin.sublink-content', compact('sublink'));
    }
}

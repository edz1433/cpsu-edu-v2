<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function createFile(){
        return view('webadmin.file-create');
    }

    public function storeFile(Request $request)
    {
        $validatedData = $request->validate([
            'storage' => 'required|string',
            'title' => 'required|string',
            'file' => 'required|file|max:102400', // Max 100MB
            'category' => 'required|string',
        ]);

        $uploadedFile = $request->file('file');
        $originalFileName = $uploadedFile->getClientOriginalName();
        $fileExtension = $uploadedFile->getClientOriginalExtension();

        // ✅ Define custom path in public folder
        $customPath = public_path('Uploads/Files/' . $validatedData['storage']);

        // ✅ Make sure folder exists
        if (!file_exists($customPath)) {
            mkdir($customPath, 0777, true);
        }

        // ✅ Move uploaded file to public folder
        $uploadedFile->move($customPath, $originalFileName);

        // ✅ Save file info to database
        $files = new File([
            'storage' => $validatedData['storage'],
            'title' => $validatedData['title'],
            'file_name' => $originalFileName,
            'file_ext' => $fileExtension,
            'category' => $validatedData['category'],
        ]);

        $files->save();

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    
}

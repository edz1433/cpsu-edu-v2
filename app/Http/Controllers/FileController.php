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
            'file' => 'required|file|max:102400',
            'category' => 'required|string',
        ]);
    
        $uploadedFile = $request->file('file');
        $originalFileName = $uploadedFile->getClientOriginalName();
        $fileExtension = $uploadedFile->getClientOriginalExtension();
        
        $customPath = 'Uploads/Files/'.$validatedData['storage'];
    
        $uploadedFile->move(public_path($customPath), $originalFileName);
    
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

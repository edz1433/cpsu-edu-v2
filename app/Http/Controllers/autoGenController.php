<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class autoGenController extends Controller
{
    public function autoGen(){
        // Select rows where category is "updates"
        $updates = DB::table('sublinks')->where('category', 'Updates')->get();

        foreach ($updates as $update) {
            $sublinkId = $update->id;
            $description = $update->description;

            // Generate a random file name
            $fileName = Str::random(10) . '.txt';

            // Get the public path for the 'files' directory
            $publicPath = public_path('oldcontent');

            // Create the 'files' directory if it doesn't exist
            if (!File::isDirectory($publicPath)) {
                File::makeDirectory($publicPath);
            }

            // Write the description content to a text file in the public/files/ directory
            $filePath = public_path('oldcontent/' . $fileName);
            file_put_contents($filePath, $description);

            // Update the description column with the file name
            DB::table('sublinks')->where('id', $sublinkId)->update(['description' => $fileName, 'image' => 'default-thumbnail.png']);
        }
    }
}



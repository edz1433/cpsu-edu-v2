<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submenu;
use App\Models\Sublink;
use App\Models\Category;
use App\Models\SubCategory;

class MasterController extends Controller
{
    public function webmenus(Request $request)
    {
        $submenu = Submenu::where('status', 1)
            ->orderBy('title', 'asc')
            ->get();

        $categories = Category::all();
        $subcategories = SubCategory::all();
        
        return response()->json([
            'submenu' => $submenu,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}
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
        $categories = Category::with([
            'subcategories.submenus' => function ($q) {
                $q->where('status', 1)->orderBy('title', 'asc');
            },
            'submenus'
        ])->get();

        return response()->json([
            'categories' => $categories
        ]);
    }
}
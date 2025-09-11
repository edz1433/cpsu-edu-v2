<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Cache;
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
        $categories = Cache::remember('categories_with_nested', 3600, function () {
            return Category::with([
                'subcategories.submenus' => function ($query) {
                    $query->where('status', 1)->select('id', 'title', 'subcategory', 'url');
                },
                'submenus' => function ($query) {
                    $query->where('status', 1)->select('id', 'title', 'category', 'url');
                }
            ])
            ->select('id', 'cat_name', 'hasgrid')
            ->get();
        });

        return response()->json([
            'categories' => $categories
        ]);
    }
}
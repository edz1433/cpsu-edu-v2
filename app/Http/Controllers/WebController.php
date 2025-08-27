<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Article;
use App\Models\Submenu;
use App\Models\Sublink;
use App\Models\Category;
use App\Models\SubCategory;

class WebController extends Controller
{
    public function webHome()
    {
        $file = File::all();
        $article = Article::latest()->paginate(10);
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('web.home', compact("article", "submenu", "file", "categories", "subcategories"));
    }

    public function viewArticle($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $file = File::all();
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        $article = Article::find($id);
        // if ($article) {
        //     $article->increment('visit');
        // }
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $category = Category::all();
        return view('web.view-article', compact("article", "submenu", "category", "articles", "file", "categories", "subcategories"));
    }

    public function subContent($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $file = File::all();
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $subcontent = Submenu::join('categories', 'submenus.category', '=', 'categories.id')
        ->where('submenus.id', $id)
        ->select('submenus.*', 'categories.cat_name')
        ->first();
        // if ($submen) {
        //     $submen->increment('visit');
        // }
        $category = Category::all();
        return view('web.view-sub-content', compact("submenu", "subcontent", "category", "articles", "file", "categories", "subcategories"));
    }
    
    public function viewSublinkContent($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $file = File::all();
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
       $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $sublink = Sublink::find($id);
        // if ($sublink) {
        //     $sublink->increment('visit');
        // }
        $category = Category::all();
        return view('web.view-sublink-content', compact("submenu", "sublink", "category", "articles", "file", "categories", "subcategories"));
    }
    
    public function searchArticle(Request $request){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $searchTerm = $request->input('s'); 
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        $file = File::all();
       $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $category = Category::all();

        $article = Article::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('web.search-article', compact("articles", "article", "submenu", "file", "category", "categories", "subcategories"));
    }

    public function history()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('web.history', compact("categories", "subcategories"));
    }

    public function vgmo()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('web.vgmo', compact("categories", "subcategories"));
    }
}   

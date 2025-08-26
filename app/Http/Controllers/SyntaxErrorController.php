<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use App\Models\Category;
use App\Models\Article;
use App\Models\Submenu;
use App\Models\Sublink;

class SyntaxErrorController extends Controller
{
    public function dashboard()
    {
        return view('webadmin.dashboard');
    }

    public function articles()
    {
        $article = Article::orderBy('created_at', 'DESC')->get();
        return view('webadmin.articles', compact('article'));
    }

    public function user()
    {
        $user = User::all();
        return view('webadmin.user', compact('user'));
    }
    
    public function File()
    {
        $file = File::all();
    
        return view('webadmin.file', compact('file'));
    }

    public function Submenu()
    {
        $user = User::all();
        $submenu = Submenu::join('categories', 'submenus.category', '=', 'categories.id')
        ->select('submenus.*', 'categories.cat_name as category_name')
        ->get();
    
        return view('webadmin.submenu', compact('submenu'));
    }

    public function Sublink()
    {
        $user = User::all();
        $sublink = Sublink::all();
        return view('webadmin.sublink', compact('sublink'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $model = $request->input('model');
    
        $modelClass = 'App\\Models\\' . $model;
    
        if (!class_exists($modelClass)) {
            return response()->json(['message' => $model . ' not found'], 404);
        }
    
        $data = new $modelClass;
    
        $data = $data->find($id);
    
        if (!$data) {
            return response()->json(['message' => $model . ' not found'], 404);
        }
    
        $data->delete();
    
        return response()->json(['message' => $model . ' deleted successfully', 'data' => $data]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}

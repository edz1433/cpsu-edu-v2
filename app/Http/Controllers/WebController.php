<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Article;
use App\Models\Submenu;
use App\Models\Sublink;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Visit;
use Normalizer;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    public function trackVisit(Request $request, &$onlineVisitors, &$todaysVisitors, &$totalPageViews)
    {
        // Record the visit
        Visit::create([
            'page'        => 'home',
            'ip_address'  => $request->ip(),
            'session_id'  => session()->getId(),   // ✅ unique per device/browser
            'user_agent'  => $request->header('User-Agent'),
            'last_seen_at'=> now(),
        ]);

        // Assign values directly
        $onlineVisitors = Visit::where('last_seen_at', '>=', now()->subMinutes(15))
            ->distinct('session_id')
            ->count('session_id');

        $todaysVisitors = Visit::whereDate('created_at', today())
            ->distinct('session_id')
            ->count('session_id');

        $totalPageViews = Visit::count();
    }

    public function webHome(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);

        $file = File::all();

        // Paginate articles
        $article = Article::latest()->paginate(10);

        // Preprocess each article
        $article->transform(function ($art) {
            // Format date
            $art->date = $art->created_at->format('M d, Y');

            // Safe title
            $title = strip_tags($art->title);
            if (class_exists('\Normalizer')) { // use global namespace
                $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $title = transliterator_transliterate('NFKC', $title);
            }
            $art->safe_title = preg_replace('/\p{Cf}/u', '', $title);

            // Thumbnail image
            $art->image = !empty($art->thumbnail) 
                ? asset("Uploads/News/thumbnail/{$art->thumbnail}") 
                : asset("Uploads/default-thumbnail.png");

            // Excerpt
            $art->excerpt = 'Content not available';
            if (!empty($art->content)) {
                $contentPath = public_path("Uploads/News/content/{$art->content}");
                if (file_exists($contentPath)) {
                    $text = strip_tags(file_get_contents($contentPath));

                    if (class_exists('\Normalizer')) {
                        $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
                    } elseif (function_exists('transliterator_transliterate')) {
                        $text = transliterator_transliterate('NFKC', $text);
                    }
                    $text = preg_replace('/\p{Cf}/u', '', $text);

                    $words = preg_split('/\s+/', $text);
                    $maxWords = 25;

                    if (count($words) > $maxWords) {
                        $art->excerpt = implode(' ', array_slice($words, 0, $maxWords)) 
                            . '... <a href="'.route('view-article', $art->id).'" style="color:#14532D;text-decoration:none;">Read More</a>';
                    } else {
                        $art->excerpt = $text;
                    }
                }
            }

            return $art;
        });

        // Other data
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('web.home', compact("article", "submenu", "file", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function viewMoreArticle(Request $request, $page = null)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);

        // Base query
        $query = Article::latest();

        // Apply search filter if present
        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%"); // optional: search content
        }

        // Paginate results and keep search query in pagination links
        $articles = $query->paginate(6)->appends($request->all());

        // Transform each article for optimized Blade rendering
        $articles->transform(function ($art) {
            // Format date
            $art->date = $art->created_at->format('M d, Y');

            // Safe title
            $title = strip_tags($art->title);
            if (class_exists('\Normalizer')) {
                $title = \Normalizer::normalize($title, \Normalizer::FORM_KC);
            } elseif (function_exists('transliterator_transliterate')) {
                $title = transliterator_transliterate('NFKC', $title);
            }
            $art->safe_title = preg_replace('/\p{Cf}/u', '', $title);

            // Thumbnail image
            $art->image = !empty($art->thumbnail) 
                ? asset("Uploads/News/thumbnail/{$art->thumbnail}") 
                : asset("Uploads/default-thumbnail.png");

            // Excerpt
            $art->excerpt = 'Content not available';
            if (!empty($art->content)) {
                $contentPath = public_path("Uploads/News/content/{$art->content}");
                if (file_exists($contentPath)) {
                    $text = strip_tags(file_get_contents($contentPath));

                    if (class_exists('\Normalizer')) {
                        $text = \Normalizer::normalize($text, \Normalizer::FORM_KC);
                    } elseif (function_exists('transliterator_transliterate')) {
                        $text = transliterator_transliterate('NFKC', $text);
                    }
                    $text = preg_replace('/\p{Cf}/u', '', $text);

                    $words = preg_split('/\s+/', $text);
                    $maxWords = 25;

                    if (count($words) > $maxWords) {
                        $art->excerpt = implode(' ', array_slice($words, 0, $maxWords)) 
                            . '... <a href="'.route('view-article', $art->id).'" style="color:#14532D;text-decoration:none;">Read More</a>';
                    } else {
                        $art->excerpt = $text;
                    }
                }
            }

            return $art;
        });

        // Other data
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('web.view-more-article', compact("articles", "submenu", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }


    public function viewArticle($id, Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
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
        return view('web.view-article', compact("article", "submenu", "category", "articles", "file", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function subContent($id, Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
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
        return view('web.view-sub-content', compact("submenu", "subcontent", "category", "articles", "file", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }
    
    public function viewSublinkContent($id)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
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
        return view('web.view-sublink-content', compact("submenu", "sublink", "category", "articles", "file", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }
    
    
    public function searchArticle(Request $request){
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $searchTerm = $request->input('s'); 
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        $file = File::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        $category = Category::all();

        $article = Article::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('web.search-article', compact("articles", "article", "submenu", "file", "category", "categories", "subcategories", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function history()
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.history', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function vgmo(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.vgmo', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function webFacilitiy(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.facilities', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function acadCalendar(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.academic-calendar', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function enrollFaqs(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.enrollment-faqs', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function gradProgram(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.graduate-program', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function undergradProgram(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();
        return view('web.undergraduate-program', compact("categories", "subcategories", "submenu", "onlineVisitors", "todaysVisitors", "totalPageViews"));
    }

    public function jobList(Request $request)
    {
        $this->trackVisit($request, $onlineVisitors, $todaysVisitors, $totalPageViews);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $submenu = Submenu::orderBy('title', 'asc')->where('status', 1)->get();

        // Fetch job list from API
        $response = Http::get('https://hris.cpsu.edu.ph/api/job-list');

        $jobs = $response->json();

        return view('web.job-hring', compact(
            'categories',
            'subcategories',
            'submenu',
            'jobs'
        ));
    }
    

}   

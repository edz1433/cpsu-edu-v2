<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SyntaxErrorController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\SublinkController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\WebController; 
use App\Http\Controllers\autoGenController;

Route::middleware(['headers.security'])->group(function () {
    Route::get('/',[WebController::class,'webHome'])->name('web-home');
    Route::get('/news/{id}', [WebController::class, 'viewArticle'])->name('view-article');
    Route::get('/content/{id}', [WebController::class, 'subContent'])->name('view-sub-content');
    Route::get('/search', [WebController::class, 'searchArticle'])->name('search-article');
    Route::get('/sublink/{id}', [WebController::class, 'viewSublinkContent'])->name('view-sublink-content');
    Route::get('/autogen', [autoGenController::class, 'autoGen'])->name('autoGen');

    //pages
    Route::get('/home', [WebController::class, 'webHome1'])->name('webHome1');
    Route::get('/history', [WebController::class, 'history'])->name('history');
    Route::get('/vgmo', [WebController::class, 'vgmo'])->name('vgmo');
    
    //Website Admin
    Route::get('/syntax-error', function () {
        return view('webadmin.login');
    });
    
    //Login
    Route::get('/syntax-error',[LoginAuthController::class,'getLogin'])->name('getLogin');
    Route::post('syntax-error/login',[LoginAuthController::class,'postLogin'])->name('postLogin');
});


Route::group(['middleware'=>['login_auth']],function(){
    Route::prefix('/syntax-error')->group(function () {
        Route::get('/dashboard',[SyntaxErrorController::class,'dashboard'])->name('admin-dashboard');

        //Uploads
        Route::get('/uploads',[SyntaxErrorController::class,'uploads'])->name('admin-uploads');
        
        //Articles
        Route::prefix('articles')->group(function () {
            Route::get('/', [SyntaxErrorController::class, 'articles'])->name('admin-articles');
            Route::get('/create', [ArticlesController::class, 'createArticles'])->name('admin-createArticles');
            Route::post('/store', [ArticlesController::class, 'storeArticles'])->name('admin-storeArticle');
            Route::get('/edit/{id}', [ArticlesController::class, 'editArticles'])->name('admin-editArticles');
            Route::post('/update/{id}', [ArticlesController::class, 'updateArticles'])->name('admin-updateArticles');
            Route::get('/content/{id}', [ArticlesController::class, 'articleContent'])->name('admin-articleContent');
        });


        //Submenu 
        Route::prefix('submenu')->group(function () {
            Route::get('/', [SyntaxErrorController::class, 'subMenu'])->name('admin-subMenu');
            Route::get('/create-submenu',[SubmenuController::class,'createSubmenu'])->name('admin-createSubmenu');
            Route::post('/store-submenu',[SubmenuController::class,'storeSubmenu'])->name('admin-storeSubmenu');
            Route::get('/edit-submenu/{id}',[SubmenuController::class,'editSubmenu'])->name('admin-editSubmenu');
            Route::post('/update-submenu/{id}',[SubmenuController::class,'updateSubmenu'])->name('admin-updateSubmenu');
            Route::get('/submenu-content/{id}',[SubmenuController::class,'subContent'])->name('admin-subContent');
            // routes/web.php
            Route::get('/subcategories/{id?}', [SubmenuController::class, 'subcategories'])->name('subcategories');
        });

        //Sublink
        Route::prefix('sublink')->group(function () {
            Route::get('/', [SyntaxErrorController::class, 'subLink'])->name('admin-subLink');
            Route::get('/create-sublink',[SublinkController::class,'createSubLink'])->name('admin-createSubLink');
            Route::post('/store-sublink',[SublinkController::class,'storeSubLink'])->name('admin-storeSubLink');
            Route::get('/edit-sublink/{id}',[SublinkController::class,'editSubLink'])->name('admin-editSublink');
            Route::post('/update-sublink/{id}',[SublinkController::class,'updateSubLink'])->name('admin-updateSublink');
            Route::get('/sublink-content/{id}',[SublinkController::class,'sublinkContent'])->name('admin-sublinkContent');
        });

        //File
        Route::prefix('file')->group(function () { 
            Route::get('/', [SyntaxErrorController::class, 'File'])->name('admin-file');
            Route::get('/create-file',[FileController::class,'createFile'])->name('admin-createFile');
            Route::post('/store-file',[FileController::class,'storeFile'])->name('admin-storeFile');
            Route::get('/edit-file/{id}',[FileController::class,'editFile'])->name('admin-editFile');
            Route::post('/update-file/{id}',[FileController::class,'updateFile'])->name('admin-updateFile');
        });

        //User
        Route::prefix('user')->group(function (){  
            Route::get('/',[SyntaxErrorController::class,'user'])->name('admin-user');
            Route::post('/user-create',[UserController::class,'userCreate'])->name('admin-userCreate');
            Route::post('/delete',[SyntaxErrorController::class,'delete'])->name('delete');
        });

        //Logout
        Route::get('/logout',[SyntaxErrorController::class,'logout'])->name('admin-logout');
    });
   
});
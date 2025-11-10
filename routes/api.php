<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\ChatbotController;

Route::get('/chatbot-data', [ChatbotController::class, 'chatbotData'])->name('chatbot-data');

Route::middleware('api.token')->group(function () {
    Route::post('/news', [ArticleController::class, 'newsList'])->name('news-list');
    Route::post('/news-preview/{id}', [ArticleController::class, 'newsPreview'])->name('news-preview');
    Route::post('/related-news', [ArticleController::class, 'relatedNews'])->name('related-news');
    Route::post('/menu-preview/{id}', [ArticleController::class, 'menuPreview'])->name('menu-preview');
    Route::get('/webmenus', [MasterController::class, 'webmenus'])->name('web-menus');
});

<?php

use App\Http\Controllers\ArticlesImageController;
use App\Http\Controllers\Front\ArticlesController;
use App\Http\Controllers\Front\ArticlesReactsController;
use App\Http\Controllers\Front\ArticlesSummaryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\front\SavedArticlesController;
use App\Http\Controllers\Front\TvArticlesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\select2;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
    Route::name('front.')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::resource('articles', ArticlesController::class);
        Route::resource('articles-summary', ArticlesSummaryController::class)->only('index');
        Route::post('ckEditorUploadImage', [ArticlesImageController::class, 'uploadImage']);
        Route::get('articles/{last_article_id}/{limit}', [ArticlesController::class, 'getMoreArticles'])->name('articles.get');
        Route::get('articles_summary/{last_article_id}/{limit}', [ArticlesController::class, 'getMoreArticlesSummary'])->name('articles.get');
        Route::post('articles/{article}/react', [ArticlesReactsController::class, 'react']);
        Route::post('articles/{article}/bookmark', [ArticlesController::class, 'bookmark']);
        Route::get('tv-articles', [TvArticlesController::class, 'index'])->name('tv-articles.index');
        Route::get('tv-articles/{article}', [TvArticlesController::class, 'show'])->name('tv-articles.show');
        Route::get('tv-articles/{last_tv_article_id}/{limit}', [TvArticlesController::class, 'getMoreTvArticles'])->name('tv-articles.get');
    
        Route::get('saved-articles', [SavedArticlesController::class, 'index'])->name('saved-articles.index');
        Route::get('saved-articles/{last_article_id}/{limit}', [SavedArticlesController::class, 'getMoreArticles'])->name('saved-articles.get');
    });
    require __DIR__.'/auth.php';
});

Route::prefix('/select2')->controller(select2::class)->name('select2.')->group(function(){
    Route::get('/article_category', 'article_category')->name('article_category');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
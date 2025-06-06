<?php

use App\Enum\AdPages;
use App\Http\Controllers\ArticlesImageController;
use App\Http\Controllers\Front\ArticlesController;
use App\Http\Controllers\Front\ArticlesReactsController;
use App\Http\Controllers\Front\ArticlesSummaryController;
use App\Http\Controllers\Front\ContactUsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\SavedArticlesController;
use App\Http\Controllers\Front\TvArticlesController;
use App\Http\Controllers\Front\WriterRequestsController;
use App\Http\Controllers\Front\WritersController;
use App\Http\Controllers\select2;
use App\Services\AdService;
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
    
        Route::resource('profile', ProfileController::class);
        Route::get('profile/{user}/{last_article_id}/{limit}', [ProfileController::class, 'getMoreArticles'])->name('profile.get');
    
        Route::view('/terms&conditions', 'front.terms-and-condition')->name('terms');

        Route::get('about-us', function(AdService $ad_service){
            $ad = $ad_service->getByPage(AdPages::About->value);
            return view('front.about-us', compact('ad'));
        })->name('about');

        Route::resource('contact-us', ContactUsController::class);

        Route::get('/writers', [WritersController::class, 'index'])->name('writers.index');
        Route::get('/writers/search', [WritersController::class, 'search'])->name('writers.search');
        Route::get('writers/{offset}/{limit}', [WritersController::class, 'getMoreWriters'])->name('writers.get');

        Route::middleware('auth')->post('request-writer', [WriterRequestsController::class, 'request'])->name('request.writer');
    });

    require_once __DIR__.'/auth.php';
});

Route::prefix('/select2')->controller(select2::class)->name('select2.')->group(function(){
    Route::get('/article_category', 'article_category')->name('article_category');
    Route::get('/tv_article_category', 'tv_article_category')->name('tv_article_category');
});
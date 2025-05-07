<?php

use App\Http\Controllers\Dashboard\ArticlesCategoriesController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\TvArticlesCategoriesController;
use App\Http\Controllers\Dashboard\TvArticlesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\WebsiteSettingsController;
use App\Http\Controllers\Dashboard\WriterRequestController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ])
    ->group(function() {

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::get('website_setting', [WebsiteSettingsController::class, 'index'])->name('website_setting.index');
        Route::put('website_setting', [WebsiteSettingsController::class, 'update'])->name('website_setting.update');
        Route::put('website_setting/logo', [WebsiteSettingsController::class, 'change_logo'])->name('website_setting.logo.update');
        Route::put('website_setting/banner', [WebsiteSettingsController::class, 'change_banner'])->name('website_setting.banner.update');
        Route::resource('tv-articles', TvArticlesController::class);
        Route::resource('tv-articles-categories', TvArticlesCategoriesController::class);
        Route::resource('articles', ArticlesController::class);
        Route::resource('articles-categories', ArticlesCategoriesController::class);
        Route::resource('writer-request', WriterRequestController::class);
        Route::put('writer-request/{writer_request}/approve', [WriterRequestController::class, 'approve']);
        Route::put('writer-request/{writer_request}/reject', [WriterRequestController::class, 'reject']);
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
<?php

use App\Http\Controllers\Front\ArticlesController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\select2;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function() {
    Route::name('front.')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::resource('articles', ArticlesController::class);
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


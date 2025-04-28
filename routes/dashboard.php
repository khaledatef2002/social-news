<?php

use App\Http\Controllers\dashboard\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
    ->group(function() {
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
        });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
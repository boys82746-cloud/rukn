<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

// ---- Public (guests included) ----
Route::get('/', [QuoteController::class, 'index'])->name('home');
Route::get('/lang/{locale}', LocaleController::class)->name('lang');

// ---- Guests only ----
Route::middleware('guest')->group(function () {
    Route::view('/signup', 'Authentication.SignUp')->name('signup');
    Route::post('/signup', [SignupController::class, 'signup']);

    Route::view('/login', 'Authentication.LogIn')->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// ---- Logged-in users only ----
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('quotes.edit');
    Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
});

// Defined last so "/quotes/create" is never mistaken for an id
Route::get('/quotes/{quote}', [QuoteController::class, 'show'])
    ->whereNumber('quote')
    ->name('quotes.show');

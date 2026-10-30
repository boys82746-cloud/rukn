<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

// ---- Public (guests included) ----
Route::get('/', [ListingController::class, 'index'])->name('home');
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

    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
});

// Defined last so "/listings/create" is never mistaken for an id
Route::get('/listings/{listing}', [ListingController::class, 'show'])
    ->whereNumber('listing')
    ->name('listings.show');

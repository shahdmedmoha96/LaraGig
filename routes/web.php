<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/login', [UserController::class, 'login'])->name('user.Login');
    Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('listings', ListingController::class);
    Route::get('/listings/manage', [ListingController::class, 'manage'])->name('listing.manage');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});
Route::get('/tag={tag}', [ListingController::class, 'index'])->name('tag.show');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/', [ListingController::class, 'index'])->name('home');

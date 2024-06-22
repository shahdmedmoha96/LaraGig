<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// show all listings
Route::get('/',[ListingController::class,'index'])->name('listings.index');
Route::get('/listings/manage',[ListingController::class,'manage'])->name('listing.manage')->middleware('auth');

// create single listings
Route::get('/listing/create',[ListingController::class,'create'])->name('listing.create')->middleware('auth');


// store listing
Route::post('/listings',[ListingController::class,'store'])->name('listing.store')->middleware('auth');

// show single listings

Route::get('/listing/{listing}',[ListingController::class,'show'])->name('listing.show');
// filter listings acroding tags
Route::get('/tag={tag}',[ListingController::class,'index'])->name('tag.show');
Route::get('storage/{logo}')->name('ListImage.show');

//edit listing
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->name('listing.edit')->middleware('auth');
Route::put('/listings/{listing}',[ListingController::class,'updata'])->name('listing.updata')->middleware('auth');
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->name('listing.destroy')->middleware('auth');




// user


// register user
Route::get('/register',[UserController::class,'create'])->name('user.create')->middleware('guest');// only guest users access this page
Route::post('/users',[UserController::class,'store'])->name('user.store');
Route::post('/logout',[UserController::class,'logout'])->name('user.logout')->middleware('auth');
Route::get('/login',[UserController::class,'Login'])->name('user.Login')->middleware('guest');
Route::post('/users/authenticate',[UserController::class,'authenticate'])->name('user.authenticate');




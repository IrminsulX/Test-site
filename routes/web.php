<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomepageImagesController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/gamespage', function () {
    return view('gamespage');
})->name('gamespage');

Route::get('/aboutpage', function () {
    return view('aboutpage');
})->name('aboutpage');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// routes/web.php
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::get('/adminhomepages', function () {
    return view('adminhomepages');
})->name('adminhomepages');


// Home Administrator Dashboard Images section

Route::get('/adminhomepage', [AdminHomepageImagesController::class, 'index']);

Route::get('/dashboard', [AdminHomepageImagesController::class, 'index']);
Route::post('/upload', [AdminHomepageImagesController::class, 'store']);
Route::delete('/delete/{image}', [AdminHomepageImagesController::class, 'destroy']);
Route::post('/edit/{image}', [AdminHomepageImagesController::class, 'update']);


Route::get('/dashboard-images', [AdminHomepageImagesController::class, 'getDashboardImages'])->name('dashboard.images');
Route::get('/featured-games', [AdminHomepageImagesController::class, 'getFeaturedGames'])->name('featured.games');

Route::post('/upload', [AdminHomepageImagesController::class, 'store'])->name('upload.image');
Route::post('/edit/{image}', [AdminHomepageImagesController::class, 'update'])->name('edit.image');
Route::delete('/delete/{image}', [AdminHomepageImagesController::class, 'destroy'])->name('delete.image');

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');



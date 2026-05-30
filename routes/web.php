<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomepageImagesController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home.page');

Route::get('/gamespage', function () {
    return view('gamespage');
})->name('gamespage');

Route::get('/aboutpage', function () {
    return view('aboutpage');
})->name('aboutpage');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::get('/adminhomepages', function () {
    return view('adminhomepages');
})->name('adminhomepages');

Route::get('/adminhomepage', [AdminHomepageImagesController::class, 'index']);

Route::get('/dashboard', [AdminHomepageImagesController::class, 'index']);
Route::post('/upload', [AdminHomepageImagesController::class, 'store'])->name('upload.image');
Route::delete('/delete/{image}', [AdminHomepageImagesController::class, 'destroy'])->name('delete.image');
Route::post('/edit/{image}', [AdminHomepageImagesController::class, 'update'])->name('edit.image');

Route::get('/dashboard-images', [AdminHomepageImagesController::class, 'getDashboardImages'])->name('dashboard.images');
Route::get('/featured-games', [AdminHomepageImagesController::class, 'getFeaturedGames'])->name('featured.games');

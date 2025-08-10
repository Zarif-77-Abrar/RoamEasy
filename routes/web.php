<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])
        ->name('admin.reviews.destroy');
});

Route::middleware(['auth', 'role:tourist'])->group(function () {
    Route::get('/tourist/dashboard', function () {
        return view('tourist.dashboard');
    })->name('tourist.dashboard');
    // Tourist review submission
    Route::post('/destinations/{destination}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

// routes/web.php
Route::get('/destinations/{destination}/reviews', [ReviewController::class, 'showForDestination'])
    ->name('reviews.showForDestination')
    ->middleware('auth');

    
Route::middleware('auth')->group(function () {
    Route::post('/favorites/toggle/{destination}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});
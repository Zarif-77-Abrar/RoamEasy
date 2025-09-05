<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminDestinationController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ItineraryDayController;

// use App\Http\Controllers\Admin\DestinationManageController;


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
    
    Route::post('/destinations/{destination}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
    
    
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries.index');
    
    Route::get('/itineraries/create', [ItineraryController::class, 'create'])->name('itineraries.create');
    
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itineraries.store');

    Route::get('/itineraries/{itinerary}', [ItineraryController::class, 'show'])
        ->name('itineraries.show'); // Manage Days page

    Route::delete('/itineraries/{itinerary}', [ItineraryController::class, 'destroy'])->name('itineraries.destroy');

    // Itinerary days
    Route::get('/itineraries/{itinerary}/days/create', [ItineraryDayController::class, 'create'])
    ->name('itineraries.days.create');

    Route::post('/itineraries/{itinerary}/days', [ItineraryDayController::class, 'store'])
    ->name('itineraries.days.store');

    Route::delete('/itineraries/{itinerary}/days/{day}', [ItineraryDayController::class, 'destroy'])
    ->name('itineraries.days.destroy');
    
    Route::get('/itineraries/{itinerary}/details', [ItineraryController::class, 'details'])
    ->name('itineraries.details');


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



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/destinations', [AdminDestinationController::class, 'index'])->name('destinations.index');
    Route::get('/destinations/create', [AdminDestinationController::class, 'create'])->name('destinations.create'); 
    Route::post('/destinations', [AdminDestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{id}/edit', [AdminDestinationController::class, 'edit'])->name('destinations.edit');
    Route::put('/destinations/{id}', [AdminDestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{id}', [AdminDestinationController::class, 'destroy'])->name('destinations.destroy');
    Route::get('/destinations/manage', [AdminDestinationController::class, 'manage'])->name('destinations.manage');
    Route::resource('hotels', AdminHotelController::class);
});


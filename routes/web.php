<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register-business', function () {
//     return view('auth/register-business');
// })->name('register.business');
Route::get('/register-business', [BusinessController::class, 'create'])->name('business.create');

Route::get('/dashboard-with-sidebar', function () {
    return view('dashboard-with-sidebar');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [CategoryController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/category-businesses', [BusinessController::class, 'categoryBusinesses'])->name('category-businesses');
    Route::get('/food-businesses', function () {
        return view('business/category-businesses');
    })->name('food-businesses');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
    Route::patch('/categories', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth'); // edit is for page
    Route::delete('/categories', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth');
});

require __DIR__.'/auth.php';

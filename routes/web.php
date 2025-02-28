<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BusinessUserController;
use App\Http\Controllers\{FavoriteController, AdminController, BusinessController};
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register-business', function () {
//     return view('auth/register-business');
// })->name('register.business');

// Route::get('/register-business', [BusinessController::class, 'create'])->name('business.create');

Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [CategoryController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // all
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin?
    // Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Route::patch('/categories', [CategoryController::class, 'update'])->name('categories.update'); // edit is for page
    // Route::delete('/categories', [CategoryController::class, 'destroy'])->name('categories.destroy'); //->middleware('auth')

    // Business routes
    Route::middleware('role:business')->group(function () {
        Route::resource('deals', DealController::class);
        Route::get('/business/deals', [BusinessController::class, 'businessDeals'])->name('business.deals.index');//business.deals.index
        Route::get('/business/deals/create', [BusinessController::class, 'createDeal'])->name('business.deals.create');
        Route::post('/business/deals', [BusinessController::class,'storeDeal'])->name('business.deals.store');
        // Claim a deal
        Route::post('/deals/claim', [DealController::class, 'claim'])->name('deals.claim');
        Route::post('/business/deals/{id}/feature', [BusinessController::class, 'featureDeal'])->name('business.deals.feature');
        Route::post('/business/deals/{id}/unfeature', [BusinessController::class, 'unfeatureDeal'])->name('business.deals.unfeature');
        Route::get('/business/users/create', [BusinessUserController::class, 'create'])->name('business.users.create');
        Route::post('/business/users', [BusinessUserController::class, 'store'])->name('business.users.store');
    });

    // Customer routes
        Route::middleware('role:customer')->group(function () {
        Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
        Route::get('/categories/deals', [CategoryController::class, 'deals'])->name('categories.deals');
        Route::get('/categories/deals/{category}', [CustomerController::class, 'index'])->name('deals.by_category');
        Route::get('/deals/{deal}', [CustomerController::class, 'show'])->name('deals.show');
        Route::get('/categories/businesses', [CategoryController::class, 'businesses'])->name('categories.businesses');
        Route::get('/categories/businesses/{category}', [BusinessController::class, 'index'])->name('businesses.by_category');
        Route::get('/businesses/{business}', [BusinessController::class, 'show'])->name('businesses.show');
        // Purchase a deal
        Route::post('/deals/purchase', [DealController::class, 'purchase'])->name('deals.purchase');
        Route::get('/purchased-deals', [OrderController::class, 'purchasedDeals'])->name('customer.purchased-deals');
        Route::get('/claimed-deals', [OrderController::class, 'claimedDeals'])->name('customer.claimed-deals');
    });

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('admin/users', UserController::class);
        Route::resource('admin/categories/list', CategoryController::class);
        Route::post('/admin/businesses/{id}/feature', [AdminController::class, 'featureBusiness'])->name('admin.businesses.feature');
        Route::post('/admin/businesses/{id}/unfeature', [AdminController::class, 'unfeatureBusiness'])->name('admin.businesses.unfeature');
        // Route::get('/admin/businesses', [AdminController::class, 'businesses'])->name('admin.businesses.index');
        Route::get('/admin/businesses/pending', [AdminController::class, 'pendingBusinesses'])->name('admin.businesses.pending');
        // Route::post('/admin/businesses/approve', [AdminController::class, 'approveBusiness'])->name('admin.businesses.approve');
        // Route::post('/admin/businesses/reject', [AdminController::class, 'rejectBusiness'])->name('admin.businesses.reject');
        // Route::post('/admin/businesses/{business}/approve', [AdminController::class, 'approveBusiness'])->name('admin.businesses.approve');
        // Route::post('/admin/businesses/{business}/reject', [AdminController::class, 'rejectBusiness'])->name('admin.businesses.reject');
        Route::post('/admin/businesses/{business}/approve', [AdminController::class, 'approve'])->name('admin.businesses.approve');
        Route::post('/admin/businesses/{business}/reject', [AdminController::class, 'reject'])->name('admin.businesses.reject');
    });
});

require __DIR__.'/auth.php';

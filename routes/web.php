<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ArtworkController as UserArtworkController;
use App\Http\Controllers\User\OrderController as UserOrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| User Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // My Artworks
    Route::resource('artworks', UserArtworkController::class)->except(['show']);
    Route::post('/artworks/{artwork}/toggle-active', [UserArtworkController::class, 'toggleActive'])->name('artworks.toggle');

    // Orders & Downloads
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/download/{artwork}', [UserOrderController::class, 'download'])->name('orders.download');
});

/*
|--------------------------------------------------------------------------
| Shopping Cart & Checkout Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{artwork}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Payment
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::get('/payment/finish', [PaymentController::class, 'finish'])->name('payment.finish');

    // Reviews
    Route::post('/artworks/{artwork}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Payment Callback (No auth required - called by Midtrans)
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Artworks Management
    Route::get('/artworks', [AdminArtworkController::class, 'index'])->name('artworks.index');
    Route::get('/artworks/create', [AdminArtworkController::class, 'create'])->name('artworks.create');
    Route::post('/artworks', [AdminArtworkController::class, 'store'])->name('artworks.store');
    Route::get('/artworks/{artwork}', [AdminArtworkController::class, 'show'])->name('artworks.show');
    Route::get('/artworks/{artwork}/edit', [AdminArtworkController::class, 'edit'])->name('artworks.edit');
    Route::put('/artworks/{artwork}', [AdminArtworkController::class, 'update'])->name('artworks.update');
    Route::post('/artworks/{artwork}/approve', [AdminArtworkController::class, 'approve'])->name('artworks.approve');
    Route::post('/artworks/{artwork}/reject', [AdminArtworkController::class, 'reject'])->name('artworks.reject');
    Route::delete('/artworks/{artwork}', [AdminArtworkController::class, 'destroy'])->name('artworks.destroy');

    // Orders Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');

    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Categories Management
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
});

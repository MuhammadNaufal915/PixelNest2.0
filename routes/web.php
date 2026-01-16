<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CategoryController as PublicCategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
=======
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ArtworkController as UserArtworkController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [PublicCategoryController::class, 'show'])->name('categories.show');
Route::get('/pricing', function () { return view('pricing'); })->name('pricing');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/search', [SearchController::class, 'search'])->name('artworks.search');
Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

// Midtrans Notification (must be accessible without auth)
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Forgot Password Routes
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'reset'])->name('password.update');
});

<<<<<<< HEAD
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

=======
// Authenticated Routes
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Artwork Public View
    Route::get('/artworks', [ArtworkController::class, 'index'])->name('artworks.index');
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{artwork}', [CartController::class, 'add'])->name('cart.add');
<<<<<<< HEAD
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
=======
    Route::post('/cart/buy-now/{artwork}', [CartController::class, 'buyNow'])->name('cart.buy-now');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    // Checkout & Payment
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
    
    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('artworks', UserArtworkController::class)->except(['show']);
        
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    });
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/artworks', [AdminArtworkController::class, 'index'])->name('artworks.index');
        Route::get('/artworks/{artwork}', [AdminArtworkController::class, 'show'])->name('artworks.show');
        Route::post('/artworks/{artwork}/approve', [AdminArtworkController::class, 'approve'])->name('artworks.approve');
        Route::post('/artworks/{artwork}/reject', [AdminArtworkController::class, 'reject'])->name('artworks.reject');
        Route::post('/artworks/{artwork}/toggle-active', [AdminArtworkController::class, 'toggleActive'])->name('artworks.toggle-active');
        Route::delete('/artworks/{artwork}', [AdminArtworkController::class, 'destroy'])->name('artworks.destroy');
        
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    });
});
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280

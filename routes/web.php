<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AiRecommendationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Farmer\FarmerDashboardController;
use App\Http\Controllers\Farmer\FarmerProductController;
use App\Http\Controllers\Farmer\FarmerOrderController;

use App\Http\Controllers\Buyer\BuyerDashboardController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'handleContactSubmit'])->name('contact.submit');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/market-prices', [MarketPriceController::class, 'index'])->name('market-prices.index');
Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
Route::get('/ai-recommendations', [AiRecommendationController::class, 'index'])->name('ai-recommendations.index');
Route::post('/ai-recommendations', [AiRecommendationController::class, 'recommend'])->name('ai-recommendations.recommend');

/*
|--------------------------------------------------------------------------
| Common Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dynamic Role-based Dashboard redirect fallback
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isFarmer()) {
            return redirect()->route('farmer.dashboard');
        }
        return redirect()->route('buyer.dashboard');
    })->name('dashboard');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat/Messaging
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats/send', [ChatController::class, 'sendMessage'])->name('chats.send');
});

/*
|--------------------------------------------------------------------------
| Farmer Routes (auth + role:farmer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:farmer'])->prefix('farmer')->name('farmer.')->group(function () {
    Route::get('/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard');
    
    // Crop Listings CRUD
    Route::resource('products', FarmerProductController::class)->except(['show']);
    
    // Order Management
    Route::get('/orders', [FarmerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [FarmerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [FarmerOrderController::class, 'updateStatus'])->name('orders.status');
});

/*
|--------------------------------------------------------------------------
| Buyer Routes (auth + role:buyer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:buyer'])->group(function () {
    // Buyer Dashboard
    Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])->name('buyer.dashboard');
    
    // Wishlist
    Route::get('/wishlist', [BuyerDashboardController::class, 'wishlist'])->name('buyer.wishlist');
    Route::post('/wishlist/toggle', [BuyerDashboardController::class, 'toggleWishlist'])->name('buyer.wishlist.toggle');

    // Cart operations
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Orders checkout & list
    Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
    // Reviews
    Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])->name('products.review');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (auth + role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Users verification and CRUD
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/verify', [AdminUserController::class, 'verify'])->name('users.verify');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Products moderation
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Categories management
    Route::get('/categories', [AdminProductController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [AdminProductController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [AdminProductController::class, 'destroyCategory'])->name('categories.destroy');
});

/*
|--------------------------------------------------------------------------
| PDF Invoice Route (available to both Buyer/Farmer/Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

require __DIR__.'/auth.php';

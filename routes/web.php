<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController as BackendPageController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Auth;
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








// For Admin Panel
Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.showLogin');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/', [BackendPageController::class, 'home'])->name('admin.home');
        // Products        
        Route::resource('products', 'Backend\ProductController');
        Route::get('/datatable', [ProductController::class, 'anyData'])->name('datatable');
        // Product Attribute
        Route::resource('products.attributes', 'Backend\AttributeController')->shallow();
        // Product Status
        Route::post('/products/status-inactive/{id}', [ProductController::class, 'statusInactive'])->name('products.status.inactive');
        Route::post('/products/status-active/{id}', [ProductController::class, 'statusActive'])->name('products.status.active');

        // Category

        Route::resource('categories', 'Backend\CategoryController');
        // Route::get('/datatable/categories', [CategoryController::class, 'anyData'])->name('datatable.categories');

        Route::post('/categories/status-inactive/{id}', [CategoryController::class, 'statusInactive'])->name('categories.status.inactive');
        Route::post('/categories/status-active/{id}', [CategoryController::class, 'statusActive'])->name('categories.status.active');

        // Category Status With Ajax
        Route::get('/changeStatus', [CategoryController::class, 'changeStatus'])->name('change.status');

        // Banner
        Route::resource('banners', 'Backend\BannerController');
        Route::get('/datatable/banners', [BannerController::class, 'anyData'])->name('datatable.banners');

        // Cupon
        Route::resource('cupons', 'Backend\CuponController');
        Route::get('/changeStatus/cupons', [CuponController::class, 'changeStatus'])->name('change.status.cupon');

        // Order
        Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/order/detail/{id}', [OrderController::class, 'orderDetail'])->name('admin.order.detail');
        Route::post('/order/update-status/{id}', [OrderController::class, 'UpdateStatus'])->name('admin.order.update-status');
        Route::get('/orders/generate/invoice/{id}', [OrderController::class, 'GenerateInvoice'])->name('admin.order.generate-invoice');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/changeStatus/users', [UserController::class, 'changeStatus'])->name('change.status.cupon');
    });
});




// User Login/Register

Auth::routes(['verify' => true]);

// For Frontend
Route::get('/', [PageController::class, 'index'])->name('home.intro');
Route::get('/products/detail/{id}', [PageController::class, 'detail'])->name('products.detail');
Route::get('/products/filter', [PageController::class, 'filter'])->name('products.filter');
Route::get('/products/getPrice', [PageController::class, 'getPrice'])->name('products.getPrice');

// For add to cart

Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'index'])->name('home')->middleware('verified');


    // Add To Cart Starts
    Route::post('/products/add-to-cart', [PageController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/products/cart', [PageController::class, 'cart'])->name('products.cart');
    Route::get('/products/delete-from-cart/{id}', [PageController::class, 'deleteFromCart'])->name('products.deleteFromCart');
    // Add To Cart Ends


    // WishList Starts
    Route::get('/products/wishlist', [PageController::class, 'wishlist'])->name('products.wishlist');
    Route::post('/products/add-to-wishlist', [PageController::class, 'addToWishlist'])->name('products.addToWishlist');
    Route::get('/products/delete-from-wishList/{id}', [PageController::class, 'deleteFromWishlist'])->name('products.deleteFromWishlist');
    Route::get('/products/wish-list-count', [PageController::class, 'wishListCount'])->name('products.wishListCount');
    // WishList Ends

    // Product Rating
    Route::post('/products/rating', [PageController::class, 'productRating'])->name('products.rating');

    // Product Review
    Route::resource('products.reviews', 'Frontend\ProductReviewController')->shallow();

    Route::get('/products/update-quantity', [PageController::class, 'updateQuantity'])->name('products.updateQuantity');

    // Search Product
    Route::get('/products/search', [PageController::class, 'index'])->name('products.search');

    // Apply Cupon
    Route::post('/products/apply/cupon', [PageController::class, 'applyCupon'])->name('apply.cupon');

    // User change Password
    Route::get('/users/change/password', [PageController::class, 'password'])->name('password');
    Route::post('/users/change/password', [PageController::class, 'updatePassword'])->name('update.password');

    // User change Address
    Route::get('/users/change/address', [PageController::class, 'address'])->name('address');
    Route::post('/users/change/address', [PageController::class, 'updateAddress'])->name('update.address');

    // Check Out
    Route::get('/users/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::post('/users/checkout', [PageController::class, 'usersCheckout'])->name('users.checkout');

    // Order
    Route::get('/users/orderReview', [PageController::class, 'orderReview'])->name('orderReview');
    Route::post('/users/orderConfirm', [PageController::class, 'orderConfirm'])->name('orderConfirm');

    // Order List
    Route::get('/users/ordersList', [PageController::class, 'ordersList'])->name('ordersList');
    Route::get('/users/ordersDetail/{id}', [PageController::class, 'orderDetail'])->name('orderDetail');

    // Thank You
    Route::get('/users/thank', [PageController::class, 'thank'])->name('thank');

    // Payment Stripe
    Route::get('/users/stripe', [PageController::class, 'stripe'])->name('stripe');

    // User Account
    Route::get('/user', [PageController::class, 'user'])->middleware('auth')->name('user');

    // About
    Route::get('/about', function () {
        return view('frontend.about');
    });

    // Service
    Route::get('/service', function () {
        return view('frontend.service');
    });

    // Contact Us
    Route::get('/contact', function () {
        return view('frontend.contact');
    });
});

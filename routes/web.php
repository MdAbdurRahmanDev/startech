<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\OfferController;
use App\Http\Controllers\Frontend\HappyHourController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\InformationController;
use App\Http\Controllers\Frontend\CartController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/product/{slug}', [ProductController::class, 'show']);

// Cart Routes
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('order.place');
Route::get('/order-success/{order_number}', [CartController::class, 'orderSuccess'])->name('order.success');
Route::get('/category/{slug}', [CategoryController::class, 'show']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/happy-hour', [HappyHourController::class, 'index']);
Route::get('/account/login', [AccountController::class, 'login'])->name('user.login');
Route::post('/account/login', [AccountController::class, 'storeLogin'])->name('user.login.store');
Route::get('/account/register', [AccountController::class, 'register'])->name('user.register');
Route::post('/account/register', [AccountController::class, 'storeRegister'])->name('user.register.store');
Route::get('/account/account', [AccountController::class, 'account'])->name('user.account');
Route::post('/account/logout', [AccountController::class, 'logout'])->name('user.logout');
Route::get('/account/edit', [AccountController::class, 'edit'])->name('user.edit');
Route::post('/account/profile/update', [AccountController::class, 'updateProfile'])->name('user.profile.update');
Route::post('/account/password/update', [AccountController::class, 'updatePassword'])->name('user.password.update');
Route::get('/account/order', [AccountController::class, 'order'])->name('user.order');
Route::get('/account/order/{id}/refund', [AccountController::class, 'showRefundForm'])->name('user.order.refund');
Route::post('/account/order/{id}/refund', [AccountController::class, 'storeRefund'])->name('user.order.refund.store');
Route::get('/account/address', [AccountController::class, 'address'])->name('user.address');

// Information Pages
Route::get('/affiliate-program', [InformationController::class, 'affiliate']);
Route::get('/emi-terms', [InformationController::class, 'emi']);
Route::get('/privacy', [InformationController::class, 'privacy']);
Route::get('/star-point-policy', [InformationController::class, 'starPoint']);
Route::get('/contact', [InformationController::class, 'contact']);
Route::get('/about_us', [InformationController::class, 'about']);
Route::get('/terms', [InformationController::class, 'terms']);
Route::get('/refund-policy', [InformationController::class, 'refund']);



include "admin.php";
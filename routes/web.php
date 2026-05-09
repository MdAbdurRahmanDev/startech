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

Route::get('/', [HomeController::class, 'index']);
Route::get('/product/{slug}', [ProductController::class, 'show']);
Route::get('/category/{slug}', [CategoryController::class, 'show']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/happy-hour', [HappyHourController::class, 'index']);
Route::get('/account/login', [AccountController::class, 'login']);
Route::get('/account/register', [AccountController::class, 'register']);
Route::get('/account/account', [AccountController::class, 'account']);
Route::get('/account/edit', [AccountController::class, 'edit']);
Route::get('/account/order', [AccountController::class, 'order']);
Route::get('/account/address', [AccountController::class, 'address']);

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
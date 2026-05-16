<?php

use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProductQuestionController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\QuotationController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\InformationController;
use App\Http\Controllers\Frontend\OfferController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\OutletController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderInvoiceController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Temporary route to clear cache on production
Route::get('/clear', function () {
    // Artisan::call('config:clear');
    // Artisan::call('cache:clear');
    // Artisan::call('view:clear');
    // Artisan::call('route:clear');
    Artisan::call('migrate', ['--force' => true]);

    // // Manual storage link for shared hosting
    // $target = storage_path('app/public');
    // $link = public_path('storage');
    // if (!file_exists($link)) {
    //     symlink($target, $link);
    // }

    return 'All cache cleared, storage linked and migration completed successfully!';
});
Route::get('/outlets', [OutletController::class, 'index'])->name('outlets.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.single');
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offer/{slug}', [OfferController::class, 'show'])->name('offers.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/custom-web-development', [ServiceController::class, 'webDevelopment'])->name('services.web-development');
Route::get('/services/apps-development', [ServiceController::class, 'appDevelopment'])->name('services.app-development');
Route::get('/services/ai-automation', [ServiceController::class, 'aiAutomation'])->name('services.ai-automation');

// Cart Routes
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buy-now');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('order.place');
Route::get('/order-success/{order_number}', [CartController::class, 'orderSuccess'])->name('order.success');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/search', [SearchController::class, 'index']);
Route::get('/account/login', [AccountController::class, 'login'])->name('login');
Route::post('/account/login', [AccountController::class, 'storeLogin'])->name('login.store');
Route::get('/account/register', [AccountController::class, 'register'])->name('user.register');
Route::post('/account/register', [AccountController::class, 'storeRegister'])->name('user.register.store');
// User Account Routes
Route::middleware('auth')->group(function () {
    Route::get('/account/account', [AccountController::class, 'account'])->name('user.account');
    Route::post('/account/logout', [AccountController::class, 'logout'])->name('user.logout');
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('user.edit');
    Route::get('/account/password', [AccountController::class, 'password'])->name('user.password');
    Route::post('/account/profile/update', [AccountController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/account/password/update', [AccountController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/account/order', [AccountController::class, 'order'])->name('user.order');
    Route::get('/account/order/{id}/refund', [AccountController::class, 'showRefundForm'])->name('user.order.refund');
    Route::post('/account/order/{id}/refund', [AccountController::class, 'storeRefund'])->name('user.order.refund.store');
    Route::get('/account/address', [AccountController::class, 'address'])->name('user.address');
    Route::post('/account/address/update', [AccountController::class, 'updateAddress'])->name('user.address.update');
    Route::get('/account/wishlist', [AccountController::class, 'wishlist'])->name('user.wishlist');
});

// Dynamic CMS Pages
Route::get('/info/{slug}', [InformationController::class, 'showPageBySlug'])->name('info.show');
Route::get('/contact', [InformationController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/quotation', [InformationController::class, 'quotation'])->name('info.quotation');
Route::post('/quotation', [QuotationController::class, 'store'])->name('quotation.store');
Route::post('/product-question', [ProductQuestionController::class, 'store'])->name('product.question.store');
Route::post('/product-review', [ProductReviewController::class, 'store'])->name('product.review.store')->middleware('auth');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle')->middleware('auth');

// Invoice Routes
Route::get('/order/invoice/{id}', [OrderInvoiceController::class, 'show'])->name('order.invoice.show')->middleware('auth');
Route::get('/order/invoice/{id}/print', [OrderInvoiceController::class, 'download'])->name('order.invoice.print')->middleware('auth');

// Order Tracking
Route::get('/order-tracking', [OrderTrackingController::class, 'index'])->name('order.track');
Route::post('/order-tracking', [OrderTrackingController::class, 'track'])->name('order.track.post');

include 'admin.php';

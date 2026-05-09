<?php

use App\Http\Controllers\Auth\AdminProfileController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminProfileController::class, 'login'])->name('login');
    Route::post('/admin/login', [AdminProfileController::class, 'loginPost']);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/admin/logout', [AdminProfileController::class, 'logout'])->name('logout');

    // Profile Settings
    Route::get('/admin/profile', [AdminProfileController::class, 'showProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');

    // Settings
    Route::get('/admin/settings/general', [\App\Http\Controllers\Backend\SettingController::class, 'general'])->name('admin.settings.general');
    Route::post('/admin/settings/update', [\App\Http\Controllers\Backend\SettingController::class, 'update'])->name('admin.settings.update');

    // Banners
    Route::get('/admin/banners', [\App\Http\Controllers\Backend\BannerController::class, 'index'])->name('admin.banners.index');
    Route::post('/admin/banners', [\App\Http\Controllers\Backend\BannerController::class, 'store'])->name('admin.banners.store');
    Route::delete('/admin/banners/{banner}', [\App\Http\Controllers\Backend\BannerController::class, 'destroy'])->name('admin.banners.destroy');
    Route::post('/admin/banners/{banner}/toggle', [\App\Http\Controllers\Backend\BannerController::class, 'toggleStatus'])->name('admin.banners.toggle');

    // Categories
    Route::get('/admin/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [\App\Http\Controllers\Backend\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::post('/admin/categories/{category}/toggle', [\App\Http\Controllers\Backend\CategoryController::class, 'toggleStatus'])->name('admin.categories.toggle');
    Route::post('/admin/categories/{category}/featured', [\App\Http\Controllers\Backend\CategoryController::class, 'toggleFeatured'])->name('admin.categories.featured');
    // Products
    Route::get('/admin/products', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [\App\Http\Controllers\Backend\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [\App\Http\Controllers\Backend\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [\App\Http\Controllers\Backend\ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::post('/admin/products/{product}/toggle', [\App\Http\Controllers\Backend\ProductController::class, 'toggleStatus'])->name('admin.products.toggle');
    Route::post('/admin/products/{product}/featured', [\App\Http\Controllers\Backend\ProductController::class, 'toggleFeatured'])->name('admin.products.featured');

    // Brands
    Route::resource('/admin/brands', \App\Http\Controllers\Backend\BrandController::class)->names('admin.brands');

    // Suppliers
    Route::resource('/admin/suppliers', \App\Http\Controllers\Backend\SupplierController::class)->names('admin.suppliers');

    // Shipping Methods
    Route::resource('/admin/shipping', \App\Http\Controllers\Backend\ShippingMethodController::class)->names('admin.shipping');

    // Orders
    Route::get('/admin/orders', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [\App\Http\Controllers\Backend\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{order}/status', [\App\Http\Controllers\Backend\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/admin/orders/{order}', [\App\Http\Controllers\Backend\OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Refunds
    Route::get('/admin/refunds', [\App\Http\Controllers\Backend\RefundController::class, 'index'])->name('admin.refunds.index');
    Route::get('/admin/refunds/{id}', [\App\Http\Controllers\Backend\RefundController::class, 'show'])->name('admin.refunds.show');
    Route::post('/admin/refunds/{id}/status', [\App\Http\Controllers\Backend\RefundController::class, 'updateStatus'])->name('admin.refunds.updateStatus');

    // Stocks
    Route::get('/admin/stock', [\App\Http\Controllers\Backend\StockController::class, 'index'])->name('admin.stock.index');
    Route::get('/admin/stock/create', [\App\Http\Controllers\Backend\StockController::class, 'create'])->name('admin.stock.create');
    Route::post('/admin/stock', [\App\Http\Controllers\Backend\StockController::class, 'store'])->name('admin.stock.store');

    // Offers
    Route::get('/admin/offers', [\App\Http\Controllers\Backend\OfferController::class, 'index'])->name('admin.offers.index');
    Route::get('/admin/offers/create', [\App\Http\Controllers\Backend\OfferController::class, 'create'])->name('admin.offers.create');
    Route::post('/admin/offers', [\App\Http\Controllers\Backend\OfferController::class, 'store'])->name('admin.offers.store');
    Route::get('/admin/offers/{offer}/edit', [\App\Http\Controllers\Backend\OfferController::class, 'edit'])->name('admin.offers.edit');
    Route::post('/admin/offers/{offer}', [\App\Http\Controllers\Backend\OfferController::class, 'update'])->name('admin.offers.update');
    Route::delete('/admin/offers/{offer}', [\App\Http\Controllers\Backend\OfferController::class, 'destroy'])->name('admin.offers.destroy');
    Route::post('/admin/offers/{offer}/toggle', [\App\Http\Controllers\Backend\OfferController::class, 'toggleStatus'])->name('admin.offers.toggle');

    // Services
    Route::get('/admin/services', [\App\Http\Controllers\Backend\ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/admin/services/create', [\App\Http\Controllers\Backend\ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/services', [\App\Http\Controllers\Backend\ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/services/{service}/edit', [\App\Http\Controllers\Backend\ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('/admin/services/{service}', [\App\Http\Controllers\Backend\ServiceController::class, 'update'])->name('admin.services.update');
    // Contacts
    Route::get('/admin/contacts', [\App\Http\Controllers\Backend\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/contacts/{contact}', [\App\Http\Controllers\Backend\ContactController::class, 'show'])->name('admin.contacts.show');
    Route::post('/admin/contacts/{contact}/reply', [\App\Http\Controllers\Backend\ContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::delete('/admin/contacts/{contact}', [\App\Http\Controllers\Backend\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    // CMS Pages
    Route::get('/admin/cms', [\App\Http\Controllers\Backend\PageController::class, 'index'])->name('admin.cms.index');
    Route::get('/admin/cms/create', [\App\Http\Controllers\Backend\PageController::class, 'create'])->name('admin.cms.create');
    Route::post('/admin/cms', [\App\Http\Controllers\Backend\PageController::class, 'store'])->name('admin.cms.store');
    Route::get('/admin/cms/{page}/edit', [\App\Http\Controllers\Backend\PageController::class, 'edit'])->name('admin.cms.edit');
    // Quotations
    Route::get('/admin/quotations', [\App\Http\Controllers\Backend\QuotationController::class, 'index'])->name('admin.quotations.index');
    Route::get('/admin/quotations/{quotation}', [\App\Http\Controllers\Backend\QuotationController::class, 'show'])->name('admin.quotations.show');
    Route::post('/admin/quotations/{quotation}/status', [\App\Http\Controllers\Backend\QuotationController::class, 'updateStatus'])->name('admin.quotations.update-status');
    Route::delete('/admin/quotations/{quotation}', [\App\Http\Controllers\Backend\QuotationController::class, 'destroy'])->name('admin.quotations.destroy');

    // Product Questions
    Route::get('/admin/questions', [\App\Http\Controllers\Backend\ProductQuestionController::class, 'index'])->name('admin.questions.index');
    Route::post('/admin/questions/{question}', [\App\Http\Controllers\Backend\ProductQuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/admin/questions/{question}', [\App\Http\Controllers\Backend\ProductQuestionController::class, 'destroy'])->name('admin.questions.destroy');

    // Product Reviews
    Route::get('/admin/reviews', [\App\Http\Controllers\Backend\ProductReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{review}', [\App\Http\Controllers\Backend\ProductReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});

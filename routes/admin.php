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
});

<?php
// routes/web.php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IssueController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->group(function () {
    // Authentication Routes
    Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [dminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('analytics', [DashboardController::class, 'getAnalytics'])->name('admin.analytics');
        Route::get('regions', [DashboardController::class, 'getRegions'])->name('admin.regions');
        Route::get('wards', [DashboardController::class, 'getWards'])->name('admin.wards');

        // Users Routes
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('users/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::post('users/{id}/verify', [UserController::class, 'verify'])->name('admin.users.verify');
        Route::post('users/{id}/reject', [UserController::class, 'rejectVerification'])->name('admin.users.reject');

        // Issues Routes
        Route::get('issues', [IssueController::class, 'index'])->name('admin.issues.index');
        Route::get('issues/{id}', [IssueController::class, 'show'])->name('admin.issues.show');
        Route::delete('issues/{id}', [IssueController::class, 'delete'])->name('admin.issues.delete');
        Route::post('issues/{id}/notify', [IssueController::class, 'sendNotification'])->name('admin.issues.notify');
    });
});

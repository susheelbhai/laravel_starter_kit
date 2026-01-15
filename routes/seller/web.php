<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\Seller\HomeController;
use App\Http\Controllers\Seller\NotificationController;

Route::middleware(['web', HandleInertiaRequests::class])->group(function () {
    Route::prefix('seller')->name('seller.')->middleware(['auth:seller'])->group(function () {
        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
        Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notification.show');
    });
    require __DIR__ . '/auth.php';
    require __DIR__ . '/settings.php';
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\HomeController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(['web', HandleInertiaRequests::class])->group(function () {
    Route::prefix('seller')->name('seller.')->middleware(['auth:seller'])->group(function () {
        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    });
    require __DIR__ . '/auth.php';
    require __DIR__ . '/settings.php';
});

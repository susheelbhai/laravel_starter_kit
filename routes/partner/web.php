<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Partner\HomeController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(['web', HandleInertiaRequests::class])->group(function () {
    Route::prefix('partner')->name('partner.')->middleware(['auth:partner'])->group(function () {
        Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    });
    require __DIR__ . '/auth.php';
    require __DIR__ . '/settings.php';
});

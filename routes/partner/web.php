<?php

use App\Http\Controllers\Partner\BusinessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Partner\ProfileController;
use App\Http\Controllers\Partner\HomeController;
use App\Http\Controllers\Partner\ProductController;

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

Route::middleware('auth_partner')->prefix('partner')->name('partner.')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/business/activate', [BusinessController::class,'activate'])->name('business.activate');
    Route::post('/business/deactivate', [BusinessController::class,'deactivate'])->name('business.deactivate');

    Route::resource('/business', BusinessController::class);
    Route::resource('/product', ProductController::class);

});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Partner\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/partner', function () {
    return view('separate.partner.dashboard');
})->middleware(['auth:partner', 'verified'])->name('partner.dashboard');

Route::prefix('partner')->name('partner.')->middleware('auth:partner')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

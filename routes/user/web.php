<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\HomeController;

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

Route::get('/dashboard', function () {
        return view('user.pages.home.index');
})->name('dashboard');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/listingDetail/{id}', [HomeController::class, 'listingDetail'])->name('listingDetail');
Route::post('/submit_review/{id}', [HomeController::class, 'submit_review'])->name('submit_review');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/tnc', [HomeController::class, 'contact'])->name('tnc');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitQuery']);

Route::middleware('auth_user')->prefix('user')->name('user.')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

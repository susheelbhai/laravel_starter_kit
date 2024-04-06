<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;

Route::get('/', function () {
    return view('separate.user.pages.home.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/{id}', [HomeController::class, 'blogDetail'])->name('blogDetail');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/service/{id}', [HomeController::class, 'serviceDetail'])->name('serviceDetail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit']);
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter');


require __DIR__.'/auth.php';

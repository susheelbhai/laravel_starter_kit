<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\TrackVisitor;
use App\Models\Visitor;

Route::middleware(['web', HandleInertiaRequests::class, TrackVisitor::class,])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    });
    // your routes here
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/blog/comment/{id}', [BlogController::class, 'postComment'])->name('blog.comment');
    Route::get('/services', [HomeController::class, 'services'])->name('services');
    Route::get('/service/{id}', [HomeController::class, 'serviceDetail'])->name('serviceDetail');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'contactSubmit']);
    Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('newsletter');
    Route::get('/tnc', [HomeController::class, 'tnc'])->name('newsletter');
    Route::get('/refund', [HomeController::class, 'refund'])->name('newsletter');
});

Route::get('/api/visitors/count', function () {
    return response()->json([
        'total' => Visitor::count(),
        'today' => Visitor::whereDate('created_at', now())->count(),
    ]);
});

require __DIR__.'/auth.php';

<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ShareDataMiddleware;

Route::get('/link-storage', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    // Check if link already exists
    if (file_exists($link)) {
        return "The link already exists: $link";
    }

    // Create the symlink
    symlink($target, $link);

    return "Symlink created successfully: $target -> $link";
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware([ShareDataMiddleware::class])->group(function () {
    require __DIR__ . '/user/web.php';
    require __DIR__ . '/seller/web.php';
    require __DIR__ . '/admin/web.php';
    require __DIR__ . '/partner/web.php';
});
<?php

use App\Http\Controllers\Partner\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Partner\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Partner\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Partner\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Partner\Auth\NewPasswordController;
use App\Http\Controllers\Partner\Auth\PasswordController;
use App\Http\Controllers\Partner\Auth\PasswordResetLinkController;
use App\Http\Controllers\Partner\Auth\SocialAuthController;
use App\Http\Controllers\Partner\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('partner')->name('partner.')->group(function () {
    Route::middleware('guest:partner')->group(function () {
        
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        // Generic social OAuth routes
        Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
            ->name('social.login')
            ->where('provider', 'google|facebook|x|linkedin');

        Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
            ->name('social.callback')
            ->where('provider', 'google|facebook|x|linkedin');


        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth:partner')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});

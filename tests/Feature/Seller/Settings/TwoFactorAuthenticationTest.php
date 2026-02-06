<?php

use App\Models\Seller;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

test('seller two factor settings page is displayed when enabled', function () {
    if (! Route::has('seller.two-factor.show')) {
        $this->markTestSkipped('Two-factor settings route is not defined.');
    }

    if (! Features::canManageTwoFactorAuthentication()) {
        $this->markTestSkipped('Two-factor authentication is not enabled.');
    }

    if (! method_exists(Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::class, 'show')) {
        $this->markTestSkipped('Two-factor settings controller method is missing.');
    }

    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller User',
            'email' => 'seller.twofactor@example.com',
            'password' => 'password',
        ]);
    });

    $this->actingAs($seller, 'seller')
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('seller.two-factor.show'))
        ->assertOk();
});

<?php

use App\Models\Partner;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

test('partner two factor settings page is displayed when enabled', function () {
    if (! Route::has('partner.two-factor.show')) {
        $this->markTestSkipped('Two-factor settings route is not defined.');
    }

    if (! Features::canManageTwoFactorAuthentication()) {
        $this->markTestSkipped('Two-factor authentication is not enabled.');
    }

    if (! method_exists(Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::class, 'show')) {
        $this->markTestSkipped('Two-factor settings controller method is missing.');
    }

    $partner = Partner::factory()->create();

    $this->actingAs($partner, 'partner')
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('partner.two-factor.show'))
        ->assertOk();
});

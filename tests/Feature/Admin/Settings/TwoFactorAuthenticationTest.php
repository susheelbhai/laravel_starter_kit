<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

test('admin two factor settings page is displayed when enabled', function () {
    if (! Route::has('admin.two-factor.show')) {
        $this->markTestSkipped('Two-factor settings route is not defined.');
    }

    if (! Features::canManageTwoFactorAuthentication()) {
        $this->markTestSkipped('Two-factor authentication is not enabled.');
    }

    if (! method_exists(Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::class, 'show')) {
        $this->markTestSkipped('Two-factor settings controller method is missing.');
    }

    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('admin.two-factor.show'))
        ->assertOk();
});

<?php

use App\Models\Admin;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

test('admin login screen can be rendered', function () {
    $this->get(route('admin.login'))
        ->assertOk();
});

test('admin can authenticate and logout', function () {
    $admin = Admin::factory()->create();

    $response = $this->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin, 'admin');
    $response->assertRedirect(route('admin.dashboard', absolute: false));

    $logout = $this->actingAs($admin, 'admin')
        ->post(route('admin.logout'));

    $this->assertGuest('admin');
    $logout->assertRedirect(route('admin.login', absolute: false));
});

test('admin cannot authenticate with invalid password', function () {
    $admin = Admin::factory()->create();

    $response = $this->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest('admin');
    $response->assertSessionHasErrors('email');
});

test('admin login is rate limited', function () {
    $admin = Admin::factory()->create();
    $key = Str::transliterate(Str::lower($admin->email.'|127.0.0.1'));

    RateLimiter::hit($key, 5);

    $response = $this->from(route('admin.login'))->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
});

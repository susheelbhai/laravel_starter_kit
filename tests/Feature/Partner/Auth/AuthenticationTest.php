<?php

use App\Models\Partner;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

test('partner login screen can be rendered', function () {
    $this->get(route('partner.login'))
        ->assertOk();
});

test('partner can authenticate and logout', function () {
    $partner = Partner::factory()->create();

    $response = $this->post(route('partner.login'), [
        'email' => $partner->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($partner, 'partner');
    $response->assertRedirect(route('partner.dashboard', absolute: false));

    $logout = $this->actingAs($partner, 'partner')
        ->post(route('partner.logout'));

    $this->assertGuest('partner');
    $logout->assertRedirect(route('partner.login', absolute: false));
});

test('partner cannot authenticate with invalid password', function () {
    $partner = Partner::factory()->create();

    $response = $this->post(route('partner.login'), [
        'email' => $partner->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest('partner');
    $response->assertSessionHasErrors('email');
});

test('partner login is rate limited', function () {
    $partner = Partner::factory()->create();
    $key = Str::transliterate(Str::lower($partner->email.'|127.0.0.1'));

    RateLimiter::hit($key, 5);

    $response = $this->from(route('partner.login'))->post(route('partner.login'), [
        'email' => $partner->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
});

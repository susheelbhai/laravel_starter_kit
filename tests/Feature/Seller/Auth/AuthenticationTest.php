<?php

use App\Models\Seller;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

function makeSeller(array $overrides = []): Seller
{
    return Seller::unguarded(function () use ($overrides) {
        return Seller::create(array_merge([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => 'password',
        ], $overrides));
    });
}

test('seller login screen can be rendered', function () {
    $this->get(route('seller.login'))
        ->assertOk();
});

test('seller can authenticate and logout', function () {
    $seller = makeSeller(['email' => 'seller.login@example.com']);

    $response = $this->post(route('seller.login'), [
        'email' => $seller->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($seller, 'seller');
    $response->assertRedirect(route('seller.dashboard', absolute: false));

    $logout = $this->actingAs($seller, 'seller')
        ->post(route('seller.logout'));

    $this->assertGuest('seller');
    $logout->assertRedirect(route('seller.login', absolute: false));
});

test('seller cannot authenticate with invalid password', function () {
    $seller = makeSeller(['email' => 'seller.invalid@example.com']);

    $response = $this->post(route('seller.login'), [
        'email' => $seller->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest('seller');
    $response->assertSessionHasErrors('email');
});

test('seller login is rate limited', function () {
    $seller = makeSeller(['email' => 'seller.rate@example.com']);
    $key = Str::transliterate(Str::lower($seller->email.'|127.0.0.1'));

    RateLimiter::hit($key, 5);

    $response = $this->from(route('seller.login'))->post(route('seller.login'), [
        'email' => $seller->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
});

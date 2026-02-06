<?php

use App\Models\Seller;
use Inertia\Testing\AssertableInertia as Assert;

test('seller confirm password screen can be rendered', function () {
    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller User',
            'email' => 'seller.confirm@example.com',
            'password' => 'password',
        ]);
    });

    $response = $this->actingAs($seller, 'seller')
        ->get(route('seller.password.confirm'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('seller/auth/confirm-password')
    );
});

test('seller password confirmation requires authentication', function () {
    $this->get(route('seller.password.confirm'))
        ->assertRedirect(route('seller.login'));
});

<?php

use App\Models\Seller;

function makeSellerForSettings(array $overrides = []): Seller
{
    return Seller::unguarded(function () use ($overrides) {
        return Seller::create(array_merge([
            'name' => 'Seller User',
            'email' => 'seller.settings@example.com',
            'password' => 'password',
        ], $overrides));
    });
}

test('seller profile page is displayed', function () {
    $seller = makeSellerForSettings(['email' => 'seller.profile@example.com']);

    $this->actingAs($seller, 'seller')
        ->get(route('seller.profile.edit'))
        ->assertOk();
});

test('seller profile information can be updated', function () {
    $seller = makeSellerForSettings(['email' => 'seller.update@example.com']);

    $response = $this->actingAs($seller, 'seller')
        ->patch(route('seller.profile.update'), [
            'name' => 'Seller Updated',
            'email' => 'seller.updated@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('seller.profile.edit'));

    $seller->refresh();

    expect($seller->name)->toBe('Seller Updated');
    expect($seller->email)->toBe('seller.updated@example.com');
});

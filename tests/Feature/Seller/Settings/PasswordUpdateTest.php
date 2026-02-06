<?php

use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

function makeSellerForPassword(array $overrides = []): Seller
{
    return Seller::unguarded(function () use ($overrides) {
        return Seller::create(array_merge([
            'name' => 'Seller User',
            'email' => 'seller.password@example.com',
            'password' => 'password',
        ], $overrides));
    });
}

test('seller password settings page is displayed', function () {
    $seller = makeSellerForPassword(['email' => 'seller.password.page@example.com']);

    $this->actingAs($seller, 'seller')
        ->get(route('seller.password.edit'))
        ->assertOk();
});

test('seller can update password', function () {
    $seller = makeSellerForPassword(['email' => 'seller.password.update@example.com']);

    $response = $this->actingAs($seller, 'seller')
        ->from(route('seller.password.edit'))
        ->put(route('seller.password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHas('success', 'password-updated')
        ->assertRedirect(route('seller.password.edit'));

    expect(Hash::check('new-password', $seller->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update seller password', function () {
    $seller = makeSellerForPassword(['email' => 'seller.password.invalid@example.com']);

    $response = $this->actingAs($seller, 'seller')
        ->from(route('seller.password.edit'))
        ->put(route('seller.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrors('current_password', null, 'updatePassword')
        ->assertRedirect(route('seller.password.edit'));
});

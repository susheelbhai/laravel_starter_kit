<?php

use App\Models\Partner;
use Illuminate\Support\Facades\Hash;

test('partner password settings page is displayed', function () {
    $partner = Partner::factory()->create();

    $this->actingAs($partner, 'partner')
        ->get(route('partner.password.edit'))
        ->assertOk();
});

test('partner can update password', function () {
    $partner = Partner::factory()->create();

    $response = $this->actingAs($partner, 'partner')
        ->from(route('partner.password.edit'))
        ->put(route('partner.password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHas('success', 'password-updated')
        ->assertRedirect(route('partner.password.edit'));

    expect(Hash::check('new-password', $partner->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update partner password', function () {
    $partner = Partner::factory()->create();

    $response = $this->actingAs($partner, 'partner')
        ->from(route('partner.password.edit'))
        ->put(route('partner.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrors('current_password', null, 'updatePassword')
        ->assertRedirect(route('partner.password.edit'));
});

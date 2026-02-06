<?php

use App\Models\Partner;

test('partner profile page is displayed', function () {
    $partner = Partner::factory()->create();

    $this->actingAs($partner, 'partner')
        ->get(route('partner.profile.edit'))
        ->assertOk();
});

test('partner profile information can be updated', function () {
    $partner = Partner::factory()->create();

    $response = $this->actingAs($partner, 'partner')
        ->patch(route('partner.profile.update'), [
            'name' => 'Partner Updated',
            'email' => 'partner.updated@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('partner.profile.edit'));

    $partner->refresh();

    expect($partner->name)->toBe('Partner Updated');
    expect($partner->email)->toBe('partner.updated@example.com');
});

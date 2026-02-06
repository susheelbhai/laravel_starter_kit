<?php

use App\Models\Partner;
use Inertia\Testing\AssertableInertia as Assert;

test('partner confirm password screen can be rendered', function () {
    $partner = Partner::factory()->create();

    $response = $this->actingAs($partner, 'partner')
        ->get(route('partner.password.confirm'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('partner/auth/confirm-password')
    );
});

test('partner password confirmation requires authentication', function () {
    $this->get(route('partner.password.confirm'))
        ->assertRedirect(route('partner.login'));
});

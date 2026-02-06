<?php

use App\Models\Admin;
use Inertia\Testing\AssertableInertia as Assert;

test('admin confirm password screen can be rendered', function () {
    $admin = Admin::factory()->create();

    $response = $this->actingAs($admin, 'admin')
        ->get(route('admin.password.confirm'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('admin/auth/confirm-password')
    );
});

test('admin password confirmation requires authentication', function () {
    $this->get(route('admin.password.confirm'))
        ->assertRedirect(route('admin.login'));
});

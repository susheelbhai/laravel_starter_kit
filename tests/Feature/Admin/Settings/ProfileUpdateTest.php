<?php

use App\Models\Admin;

test('admin profile page is displayed', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.profile.edit'))
        ->assertOk();
});

test('admin profile information can be updated', function () {
    $admin = Admin::factory()->create();

    $response = $this->actingAs($admin, 'admin')
        ->patch(route('admin.profile.update'), [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('admin.profile.edit'));

    $admin->refresh();

    expect($admin->name)->toBe('Admin User');
    expect($admin->email)->toBe('admin@example.com');
});

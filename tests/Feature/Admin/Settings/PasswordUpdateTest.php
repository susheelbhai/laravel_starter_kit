<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

test('admin password settings page is displayed', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.password.edit'))
        ->assertOk();
});

test('admin can update password', function () {
    $admin = Admin::factory()->create();

    $response = $this->actingAs($admin, 'admin')
        ->from(route('admin.password.edit'))
        ->put(route('admin.password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHas('success', 'password-updated')
        ->assertRedirect(route('admin.password.edit'));

    expect(Hash::check('new-password', $admin->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update admin password', function () {
    $admin = Admin::factory()->create();

    $response = $this->actingAs($admin, 'admin')
        ->from(route('admin.password.edit'))
        ->put(route('admin.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrors('current_password', null, 'updatePassword')
        ->assertRedirect(route('admin.password.edit'));
});

<?php

use App\Models\Admin;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.profile@example.com',
            'phone' => '9000001101',
            'password' => 'password',
        ]);
    });
});

test('admin can view profile page', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.profile.edit'))
        ->assertOk();
});

test('admin can update profile', function () {
    $payload = [
        'name' => 'Updated Admin',
        'email' => 'updated.profile@example.com',
        'phone' => '9000001102',
    ];

    $this->actingAs($this->admin, 'admin')
        ->patch(route('admin.profile.update'), $payload)
        ->assertRedirect(route('admin.profile.edit'));

    $this->assertDatabaseHas('admins', [
        'id' => $this->admin->id,
        'email' => 'updated.profile@example.com',
        'phone' => '9000001102',
    ]);
});

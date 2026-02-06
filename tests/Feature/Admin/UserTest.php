<?php

use App\Models\Admin;
use App\Models\User;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.user@example.com',
            'phone' => '9000000301',
            'password' => 'password',
        ]);
    });
});

test('admin can view user pages', function () {
    $user = User::unguarded(function () {
        return User::create([
            'name' => 'User One',
            'email' => 'user.one@example.com',
            'phone' => '8200000001',
            'password' => 'password',
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.user.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.user.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.user.show', $user->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.user.edit', $user->id))
        ->assertOk();
});

test('admin can create a user', function () {
    $payload = [
        'name' => 'New User',
        'email' => 'new.user@example.com',
        'phone' => '8200000002',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.user.store'), $payload);

    $response->assertRedirect(route('admin.user.index'));

    $this->assertDatabaseHas('users', [
        'email' => 'new.user@example.com',
        'phone' => '8200000002',
    ]);
});

test('admin can update a user', function () {
    $user = User::unguarded(function () {
        return User::create([
            'name' => 'Old User',
            'email' => 'old.user@example.com',
            'phone' => '8200000003',
            'password' => 'password',
        ]);
    });

    $payload = [
        'name' => 'Updated User',
        'email' => 'updated.user@example.com',
        'phone' => '8200000004',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.user.update', $user->id), $payload);

    $response->assertRedirect(route('admin.user.update', $user->id));

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'email' => 'updated.user@example.com',
        'phone' => '8200000004',
    ]);
});

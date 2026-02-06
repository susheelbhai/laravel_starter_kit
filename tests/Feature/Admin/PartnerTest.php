<?php

use App\Models\Admin;
use App\Models\Partner;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.partner@example.com',
            'phone' => '9000000101',
            'password' => 'password',
        ]);
    });
});

test('admin can view partner pages', function () {
    $partner = Partner::unguarded(function () {
        return Partner::create([
            'name' => 'Partner One',
            'email' => 'partner.one@example.com',
            'phone' => '8000000001',
            'password' => 'password',
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.partner.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.partner.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.partner.show', $partner->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.partner.edit', $partner->id))
        ->assertOk();
});

test('admin can create a partner', function () {
    $payload = [
        'name' => 'New Partner',
        'email' => 'new.partner@example.com',
        'phone' => '8000000002',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.partner.store'), $payload);

    $response->assertRedirect(route('admin.partner.index'));

    $this->assertDatabaseHas('partners', [
        'email' => 'new.partner@example.com',
        'phone' => '8000000002',
    ]);
});

test('admin can update a partner', function () {
    $partner = Partner::unguarded(function () {
        return Partner::create([
            'name' => 'Old Partner',
            'email' => 'old.partner@example.com',
            'phone' => '8000000003',
            'password' => 'password',
        ]);
    });

    $payload = [
        'name' => 'Updated Partner',
        'email' => 'updated.partner@example.com',
        'phone' => '8000000004',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.partner.update', $partner->id), $payload);

    $response->assertRedirect(route('admin.partner.update', $partner->id));

    $this->assertDatabaseHas('partners', [
        'id' => $partner->id,
        'email' => 'updated.partner@example.com',
        'phone' => '8000000004',
    ]);
});

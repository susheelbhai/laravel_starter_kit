<?php

use App\Models\Admin;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.users@example.com',
            'phone' => '9000000001',
            'password' => 'password',
        ]);
    });

    $this->superAdminRole = Role::firstOrCreate([
        'name' => 'Super Admin',
        'guard_name' => 'admin',
    ]);

    $this->admin->assignRole($this->superAdminRole);

    $this->targetAdmin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Target Admin',
            'email' => 'target.admin@example.com',
            'phone' => '9000000002',
            'password' => 'password',
        ]);
    });
});

test('admin can view admin pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.admin.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.admin.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.admin.show', $this->targetAdmin->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.admin.edit', $this->targetAdmin->id))
        ->assertOk();
});

test('admin can create another admin', function () {
    $payload = [
        'name' => 'New Admin',
        'email' => 'new.admin@example.com',
        'phone' => '9000000003',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.admin.store'), $payload);

    $response->assertRedirect(route('admin.admin.index'));

    $this->assertDatabaseHas('admins', [
        'email' => 'new.admin@example.com',
        'phone' => '9000000003',
    ]);
});

test('admin can update another admin', function () {
    $payload = [
        'name' => 'Updated Admin',
        'email' => 'updated.admin@example.com',
        'phone' => '9000000004',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.admin.update', $this->targetAdmin->id), $payload);

    $response->assertRedirect(route('admin.admin.index'));

    $this->assertDatabaseHas('admins', [
        'id' => $this->targetAdmin->id,
        'email' => 'updated.admin@example.com',
        'phone' => '9000000004',
    ]);
});

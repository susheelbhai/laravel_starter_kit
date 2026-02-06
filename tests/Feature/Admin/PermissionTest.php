<?php

use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.permissions@example.com',
            'phone' => '9000000020',
            'password' => 'password',
        ]);
    });

    $this->superAdminRole = Role::firstOrCreate([
        'name' => 'Super Admin',
        'guard_name' => 'admin',
    ]);

    $this->admin->assignRole($this->superAdminRole);

    $this->role = Role::create([
        'name' => 'Support',
        'guard_name' => 'admin',
    ]);
});

test('admin can view permission pages', function () {
    $permission = Permission::create([
        'name' => 'edit-settings',
        'guard_name' => 'admin',
    ]);

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.permission.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.permission.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.permission.edit', $permission->id))
        ->assertOk();
});

test('admin can create a permission', function () {
    $payload = [
        'name' => 'manage-reports',
        'roles' => [$this->role->id],
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.permission.store'), $payload);

    $response->assertRedirect(route('admin.permission.index'));

    $this->assertDatabaseHas('permissions', [
        'name' => 'manage-reports',
    ]);
});

test('admin can update a permission', function () {
    $permission = Permission::create([
        'name' => 'edit-content',
        'guard_name' => 'admin',
    ]);

    $payload = [
        'name' => 'edit-content-plus',
        'roles' => [$this->role->id],
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.permission.update', $permission->id), $payload);

    $response->assertRedirect(route('admin.permission.index'));

    $this->assertDatabaseHas('permissions', [
        'id' => $permission->id,
        'name' => 'edit-content-plus',
    ]);
});

test('admin can delete a permission', function () {
    $permission = Permission::create([
        'name' => 'delete-content',
        'guard_name' => 'admin',
    ]);

    $response = $this->actingAs($this->admin, 'admin')
        ->delete(route('admin.permission.destroy', $permission->id));

    $response->assertRedirect(route('admin.permission.index'));

    $this->assertDatabaseMissing('permissions', [
        'id' => $permission->id,
    ]);
});

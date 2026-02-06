<?php

use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.roles@example.com',
            'phone' => '9000000010',
            'password' => 'password',
        ]);
    });

    $this->superAdminRole = Role::firstOrCreate([
        'name' => 'Super Admin',
        'guard_name' => 'admin',
    ]);

    $this->admin->assignRole($this->superAdminRole);

    $this->permission = Permission::create([
        'name' => 'view-reports',
        'guard_name' => 'admin',
    ]);
});

test('admin can view role pages', function () {
    $role = Role::create([
        'name' => 'Manager',
        'guard_name' => 'admin',
    ]);

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.role.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.role.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.role.edit', $role->id))
        ->assertOk();
});

test('admin can create a role', function () {
    $payload = [
        'name' => 'Editor',
        'permissions' => [$this->permission->id],
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.role.store'), $payload);

    $response->assertRedirect(route('admin.role.index'));

    $this->assertDatabaseHas('roles', [
        'name' => 'Editor',
    ]);
});

test('admin can update a role', function () {
    $role = Role::create([
        'name' => 'Reviewer',
        'guard_name' => 'admin',
    ]);

    $payload = [
        'name' => 'Senior Reviewer',
        'permissions' => [$this->permission->id],
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.role.update', $role->id), $payload);

    $response->assertRedirect(route('admin.role.index'));

    $this->assertDatabaseHas('roles', [
        'id' => $role->id,
        'name' => 'Senior Reviewer',
    ]);
});

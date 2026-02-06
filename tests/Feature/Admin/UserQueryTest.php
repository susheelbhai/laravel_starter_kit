<?php

use App\Models\Admin;
use App\Models\UserQuery;
use App\Models\UserQueryStatus;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.userquery@example.com',
            'password' => 'password',
        ]);
    });

    UserQueryStatus::query()->insert([
        'id' => 1,
        'name' => 'New',
    ]);

    UserQueryStatus::query()->insert([
        'id' => 2,
        'name' => 'Resolved',
    ]);
});

test('admin can view user query pages', function () {
    $query = UserQuery::unguarded(function () {
        return UserQuery::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'status_id' => 1,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.userQuery.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.userQuery.show', $query->id))
        ->assertOk();
});

test('admin can update user query status', function () {
    $query = UserQuery::unguarded(function () {
        return UserQuery::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'status_id' => 1,
        ]);
    });

    $payload = [
        'status' => 2,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.userQuery.update', $query->id), $payload);

    $response->assertRedirect(route('admin.userQuery.index'));

    $this->assertDatabaseHas('user_queries', [
        'id' => $query->id,
        'status_id' => 2,
    ]);
});

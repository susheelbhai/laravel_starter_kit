<?php

use App\Models\Admin;
use App\Models\Team;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.team@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view team pages', function () {
    $team = Team::unguarded(function () {
        return Team::create([
            'name' => 'Team Member',
            'designation' => 'Developer',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.team.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.team.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.team.show', $team->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.team.edit', $team->id))
        ->assertOk();
});

test('admin can create a team member', function () {
    $payload = [
        'name' => 'New Member',
        'designation' => 'Designer',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.team.store'), $payload);

    $response->assertRedirect(route('admin.team.index'));

    $this->assertDatabaseHas('team', [
        'name' => 'New Member',
    ]);
});

test('admin can update a team member', function () {
    $team = Team::unguarded(function () {
        return Team::create([
            'name' => 'Old Member',
            'designation' => 'Developer',
            'is_active' => true,
        ]);
    });

    $payload = [
        'name' => 'Updated Member',
        'designation' => 'Lead Developer',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.team.update', $team->id), $payload);

    $response->assertRedirect(route('admin.team.index'));

    $this->assertDatabaseHas('team', [
        'id' => $team->id,
        'name' => 'Updated Member',
    ]);
});

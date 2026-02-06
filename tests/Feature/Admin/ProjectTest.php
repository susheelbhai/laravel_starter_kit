<?php

use App\Models\Admin;
use App\Models\Project;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.project@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view project pages', function () {
    $project = Project::unguarded(function () {
        return Project::create([
            'title' => 'Project One',
            'slug' => 'project-one',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.project.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.project.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.project.show', $project->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.project.edit', $project->id))
        ->assertOk();
});

test('admin can create a project', function () {
    $payload = [
        'title' => 'New Project',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.project.store'), $payload);

    $response->assertRedirect(route('admin.project.index'));

    $this->assertDatabaseHas('projects', [
        'title' => 'New Project',
        'slug' => Str::slug('New Project'),
    ]);
});

test('admin can update a project', function () {
    $project = Project::unguarded(function () {
        return Project::create([
            'title' => 'Old Project',
            'slug' => 'old-project',
            'is_active' => true,
        ]);
    });

    $payload = [
        'title' => 'Updated Project',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.project.update', $project->id), $payload);

    $response->assertRedirect(route('admin.project.index'));

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Updated Project',
    ]);
});

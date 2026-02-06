<?php

use App\Models\Admin;
use App\Models\Service;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.service@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view service pages', function () {
    $service = Service::unguarded(function () {
        return Service::create([
            'title' => 'Service One',
            'slug' => 'service-one',
            'long_description1' => 'Content',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.service.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.service.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.service.show', $service->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.service.edit', $service->id))
        ->assertOk();
});

test('admin can create a service', function () {
    $payload = [
        'title' => 'New Service',
        'long_description1' => 'Long content',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.service.store'), $payload);

    $response->assertRedirect(route('admin.service.index'));

    $this->assertDatabaseHas('services', [
        'title' => 'New Service',
        'slug' => Str::slug('New Service'),
    ]);
});

test('admin can update a service', function () {
    $service = Service::unguarded(function () {
        return Service::create([
            'title' => 'Old Service',
            'slug' => 'old-service',
            'long_description1' => 'Old content',
            'is_active' => true,
        ]);
    });

    $payload = [
        'title' => 'Updated Service',
        'long_description1' => 'Updated content',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.service.update', $service->id), $payload);

    $response->assertRedirect(route('admin.service.index'));

    $this->assertDatabaseHas('services', [
        'id' => $service->id,
        'title' => 'Updated Service',
    ]);
});

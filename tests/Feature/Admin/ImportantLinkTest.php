<?php

use App\Models\Admin;
use App\Models\ImportantLink;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.important-links@example.com',
            'phone' => '9000000501',
            'password' => 'password',
        ]);
    });
});

test('admin can view important link pages', function () {
    $link = ImportantLink::unguarded(function () {
        return ImportantLink::create([
            'name' => 'Link One',
            'href' => 'https://example.com',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.important_links.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.important_links.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.important_links.show', $link->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.important_links.edit', $link->id))
        ->assertOk();
});

test('admin can create an important link', function () {
    $payload = [
        'name' => 'New Link',
        'href' => 'https://new.example',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.important_links.store'), $payload);

    $response->assertRedirect(route('admin.important_links.index'));

    $this->assertDatabaseHas('important_links', [
        'name' => 'New Link',
        'href' => 'https://new.example',
    ]);
});

test('admin can update an important link', function () {
    $link = ImportantLink::unguarded(function () {
        return ImportantLink::create([
            'name' => 'Old Link',
            'href' => 'https://old.example',
            'is_active' => true,
        ]);
    });

    $payload = [
        'name' => 'Updated Link',
        'href' => 'https://updated.example',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.important_links.update', $link->id), $payload);

    $response->assertRedirect(route('admin.important_links.index'));

    $this->assertDatabaseHas('important_links', [
        'id' => $link->id,
        'name' => 'Updated Link',
        'href' => 'https://updated.example',
    ]);
});

<?php

use App\Models\Admin;
use App\Models\Portfolio;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.portfolio@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view portfolio pages', function () {
    $portfolio = Portfolio::unguarded(function () {
        return Portfolio::create([
            'name' => 'Client',
            'url' => 'https://example.com',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.portfolio.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.portfolio.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.portfolio.show', $portfolio->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.portfolio.edit', $portfolio->id))
        ->assertOk();
});

test('admin can create a portfolio entry', function () {
    $payload = [
        'name' => 'New Portfolio',
        'url' => 'https://example.test',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.portfolio.store'), $payload);

    $response->assertRedirect(route('admin.portfolio.index'));

    $this->assertDatabaseHas('clients', [
        'name' => 'New Portfolio',
        'url' => 'https://example.test',
    ]);
});

test('admin can update a portfolio entry', function () {
    $portfolio = Portfolio::unguarded(function () {
        return Portfolio::create([
            'name' => 'Old Portfolio',
            'url' => 'https://old.example',
            'is_active' => true,
        ]);
    });

    $payload = [
        'name' => 'Updated Portfolio',
        'url' => 'https://new.example',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.portfolio.update', $portfolio->id), $payload);

    $response->assertRedirect(route('admin.portfolio.index'));

    $this->assertDatabaseHas('clients', [
        'id' => $portfolio->id,
        'name' => 'Updated Portfolio',
        'url' => 'https://new.example',
    ]);
});

<?php

use App\Models\Admin;
use App\Models\Testimonial;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.testimonial@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view testimonial pages', function () {
    $testimonial = Testimonial::unguarded(function () {
        return Testimonial::create([
            'name' => 'Client',
            'message' => 'Great work',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.testimonial.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.testimonial.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.testimonial.show', $testimonial->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.testimonial.edit', $testimonial->id))
        ->assertOk();
});

test('admin can create a testimonial', function () {
    $payload = [
        'name' => 'New Client',
        'message' => 'Awesome',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.testimonial.store'), $payload);

    $response->assertRedirect(route('admin.testimonial.index'));

    $this->assertDatabaseHas('testimonials', [
        'name' => 'New Client',
    ]);
});

test('admin can update a testimonial', function () {
    $testimonial = Testimonial::unguarded(function () {
        return Testimonial::create([
            'name' => 'Old Client',
            'message' => 'Old message',
            'is_active' => true,
        ]);
    });

    $payload = [
        'name' => 'Updated Client',
        'message' => 'Updated message',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.testimonial.update', $testimonial->id), $payload);

    $response->assertRedirect(route('admin.testimonial.index'));

    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'name' => 'Updated Client',
    ]);
});

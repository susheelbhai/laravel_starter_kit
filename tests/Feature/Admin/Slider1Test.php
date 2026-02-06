<?php

use App\Models\Admin;
use App\Models\Slider1;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.slider1@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view slider pages', function () {
    $slider = Slider1::unguarded(function () {
        return Slider1::create([
            'heading1' => 'Heading',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.slider1.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.slider1.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.slider1.edit', $slider->id))
        ->assertOk();
});

test('admin can create a slider', function () {
    $payload = [
        'heading1' => 'New Slider',
        'image1' => UploadedFile::fake()->image('slide.jpg'),
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.slider1.store'), $payload);

    $response->assertRedirect(route('admin.slider1.index'));

    $this->assertDatabaseHas('slider1', [
        'heading1' => 'New Slider',
    ]);
});

test('admin can update a slider', function () {
    $slider = Slider1::unguarded(function () {
        return Slider1::create([
            'heading1' => 'Old Slider',
            'is_active' => true,
        ]);
    });

    $payload = [
        'heading1' => 'Updated Slider',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.slider1.update', $slider->id), $payload);

    $response->assertRedirect(route('admin.slider1.index'));

    $this->assertDatabaseHas('slider1', [
        'id' => $slider->id,
        'heading1' => 'Updated Slider',
    ]);
});

<?php

use App\Models\Admin;
use App\Models\Gallery;

test('admin gallery index', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')->get(route('admin.gallery.index'))->assertInertia(fn ($page) => $page->component('admin/resources/gallery/index'));
});

test('admin gallery create', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')->get(route('admin.gallery.create'))->assertInertia(fn ($page) => $page->component('admin/resources/gallery/create'));
});

test('admin gallery store', function () {
    $admin = Admin::factory()->create();

    $data = [
        'title' => 'Test Gallery',
        'description' => 'Test Description',
    ];

    $this->actingAs($admin, 'admin')->post(route('admin.gallery.store'), $data)
        ->assertRedirect(route('admin.gallery.index'));

    $this->assertDatabaseHas('galleries', $data);
});

test('admin gallery show', function () {
    $admin = Admin::factory()->create();
    $gallery = Gallery::factory()->create();

    // Generate a temporary image file
    $tmpImage = tempnam(sys_get_temp_dir(), 'test_img_') . '.jpg';
    $img = imagecreatetruecolor(100, 100);
    $bg = imagecolorallocate($img, 255, 0, 0);
    imagefill($img, 0, 0, $bg);
    imagejpeg($img, $tmpImage);
    imagedestroy($img);

    $gallery->addMedia($tmpImage)->toMediaCollection('images');

    $response = $this->actingAs($admin, 'admin')->get(route('admin.gallery.show', $gallery->id));
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page->component('admin/resources/gallery/show'));
    $response->assertSee($gallery->title);

    // Clean up temp image
    @unlink($tmpImage);
});

test('admin gallery edit', function () {
    $admin = Admin::factory()->create();
    $gallery = Gallery::factory()->create();

    $this->actingAs($admin, 'admin')->get(route('admin.gallery.edit', $gallery->id))->assertInertia(fn ($page) => $page->component('admin/resources/gallery/edit'));
});

test('admin gallery update', function () {
    $admin = Admin::factory()->create();
    $gallery = Gallery::factory()->create();

    $data = [
        'title' => 'Updated Gallery',
        'description' => 'Updated Description',
    ];

    $this->actingAs($admin, 'admin')->put(route('admin.gallery.update', $gallery->id), $data)
        ->assertRedirect(route('admin.gallery.index'));

    $this->assertDatabaseHas('galleries', $data);
});

test('admin gallery destroy', function () {
    $admin = Admin::factory()->create();
    $gallery = Gallery::factory()->create();

    $this->actingAs($admin, 'admin')->delete(route('admin.gallery.destroy', $gallery->id))
        ->assertRedirect(route('admin.gallery.index'));

    $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
});
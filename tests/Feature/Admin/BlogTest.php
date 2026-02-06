<?php

use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.blog@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view blog pages', function () {
    $blog = Blog::unguarded(function () {
        return Blog::create([
            'title' => 'Test Blog',
            'slug' => 'test-blog',
            'long_description1' => 'Content',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.blog.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.blog.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.blog.show', $blog->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.blog.edit', $blog->id))
        ->assertOk();
});

test('admin can create a blog', function () {
    $payload = [
        'title' => 'New Blog',
        'long_description1' => 'Long content',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.blog.store'), $payload);

    $response->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseHas('blogs', [
        'title' => 'New Blog',
        'slug' => Str::slug('New Blog'),
        'long_description1' => 'Long content',
    ]);
});

test('admin can update a blog', function () {
    $blog = Blog::unguarded(function () {
        return Blog::create([
            'title' => 'Old Blog',
            'slug' => 'old-blog',
            'long_description1' => 'Old content',
            'is_active' => true,
        ]);
    });

    $payload = [
        'title' => 'Updated Blog',
        'long_description1' => 'Updated content',
        'is_active' => true,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.blog.update', $blog->id), $payload);

    $response->assertRedirect(route('admin.blog.index'));

    $this->assertDatabaseHas('blogs', [
        'id' => $blog->id,
        'title' => 'Updated Blog',
        'long_description1' => 'Updated content',
    ]);
});

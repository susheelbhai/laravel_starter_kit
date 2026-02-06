<?php

use App\Models\Admin;
use App\Models\ProductCategory;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.product-category@example.com',
            'password' => 'password',
        ]);
    });
});

test('admin can view product category pages', function () {
    $category = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Category One',
            'slug' => 'category-one',
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product_category.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product_category.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product_category.show', $category->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product_category.edit', $category->id))
        ->assertOk();
});

test('admin can create a product category', function () {
    $payload = [
        'title' => 'New Category',
        'is_active' => 1,
        'is_featured' => 0,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.product_category.store'), $payload);

    $response->assertRedirect(route('admin.product_category.index'));

    $this->assertDatabaseHas('product_categories', [
        'title' => 'New Category',
    ]);
});

test('admin can update a product category', function () {
    $category = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Old Category',
            'slug' => 'old-category',
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $payload = [
        'title' => 'Updated Category',
        'is_active' => 1,
        'is_featured' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.product_category.update', $category->id), $payload);

    $response->assertRedirect(route('admin.product_category.index'));

    $this->assertDatabaseHas('product_categories', [
        'id' => $category->id,
        'title' => 'Updated Category',
    ]);
});

test('admin can delete a product category', function () {
    $category = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Delete Category',
            'slug' => 'delete-category',
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $response = $this->actingAs($this->admin, 'admin')
        ->delete(route('admin.product_category.destroy', $category->id));

    $response->assertRedirect(route('admin.product_category.index'));

    $this->assertDatabaseMissing('product_categories', [
        'id' => $category->id,
    ]);
});

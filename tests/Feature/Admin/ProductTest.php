<?php

use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductCategory;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.product@example.com',
            'password' => 'password',
        ]);
    });

    $this->category = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Product Category',
            'slug' => 'product-category',
            'is_active' => true,
            'is_featured' => false,
        ]);
    });
});

test('admin can view product pages', function () {
    $product = Product::unguarded(function () {
        return Product::create([
            'product_category_id' => $this->category->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 10.5,
            'manage_stock' => 1,
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product.show', $product->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.product.edit', $product->id))
        ->assertOk();
});

test('admin can create a product', function () {
    $payload = [
        'product_category_id' => $this->category->id,
        'title' => 'New Product',
        'price' => 99.99,
        'manage_stock' => 1,
        'is_active' => 1,
        'is_featured' => 0,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.product.store'), $payload);

    $response->assertRedirect(route('admin.product.index'));

    $this->assertDatabaseHas('products', [
        'title' => 'New Product',
        'product_category_id' => $this->category->id,
    ]);
});

test('admin can update a product', function () {
    $product = Product::unguarded(function () {
        return Product::create([
            'product_category_id' => $this->category->id,
            'title' => 'Old Product',
            'slug' => 'old-product',
            'price' => 15,
            'manage_stock' => 1,
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $payload = [
        'product_category_id' => $this->category->id,
        'title' => 'Updated Product',
        'price' => 25,
        'manage_stock' => 1,
        'is_active' => 1,
        'is_featured' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.product.update', $product->id), $payload);

    $response->assertRedirect(route('admin.product.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'title' => 'Updated Product',
        'price' => 25,
    ]);
});

test('admin can delete a product', function () {
    $product = Product::unguarded(function () {
        return Product::create([
            'product_category_id' => $this->category->id,
            'title' => 'Delete Product',
            'slug' => 'delete-product',
            'price' => 5,
            'manage_stock' => 1,
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $response = $this->actingAs($this->admin, 'admin')
        ->delete(route('admin.product.destroy', $product->id));

    $response->assertRedirect(route('admin.product.index'));

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});

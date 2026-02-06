<?php

use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductEnquiry;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.product-enquiry@example.com',
            'phone' => '9000000401',
            'password' => 'password',
        ]);
    });

    $this->category = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Category',
            'slug' => 'category',
            'is_active' => true,
            'is_featured' => false,
        ]);
    });

    $this->product = Product::unguarded(function () {
        return Product::create([
            'product_category_id' => $this->category->id,
            'title' => 'Product',
            'slug' => 'product',
            'price' => 12.5,
            'manage_stock' => 1,
            'is_active' => true,
            'is_featured' => false,
        ]);
    });
});

test('admin can view product enquiry pages', function () {
    $enquiry = ProductEnquiry::unguarded(function () {
        return ProductEnquiry::create([
            'product_id' => $this->product->id,
            'name' => 'Customer',
            'email' => 'customer@example.com',
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.productEnquiry.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.productEnquiry.show', $enquiry->id))
        ->assertOk();
});

test('admin can update product enquiry status', function () {
    $enquiry = ProductEnquiry::unguarded(function () {
        return ProductEnquiry::create([
            'product_id' => $this->product->id,
            'name' => 'Customer',
            'email' => 'customer@example.com',
        ]);
    });

    $payload = [
        'status' => 'resolved',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.productEnquiry.update', $enquiry->id), $payload);

    $response->assertRedirect(route('admin.productEnquiry.index'));

    $this->assertDatabaseHas('product_enquiries', [
        'id' => $enquiry->id,
        'status' => 'resolved',
    ]);
});

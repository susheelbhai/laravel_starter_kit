<?php

use App\Events\SellerCreated;
use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.seller@example.com',
            'phone' => '9000000201',
            'password' => 'password',
        ]);
    });
});

test('admin can view seller pages', function () {
    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller One',
            'email' => 'seller.one@example.com',
            'phone' => '8100000001',
            'password' => 'password',
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.seller.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.seller.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.seller.show', $seller->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.seller.edit', $seller->id))
        ->assertOk();
});

test('admin can create a seller', function () {
    Event::fake([SellerCreated::class]);

    $payload = [
        'name' => 'New Seller',
        'email' => 'new.seller@example.com',
        'phone' => '8100000002',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.seller.store'), $payload);

    $response->assertRedirect(route('admin.seller.index'));

    $this->assertDatabaseHas('sellers', [
        'email' => 'new.seller@example.com',
        'phone' => '8100000002',
    ]);

    Event::assertDispatched(SellerCreated::class);
});

test('admin can update a seller', function () {
    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Old Seller',
            'email' => 'old.seller@example.com',
            'phone' => '8100000003',
            'password' => 'password',
        ]);
    });

    $payload = [
        'name' => 'Updated Seller',
        'email' => 'updated.seller@example.com',
        'phone' => '8100000004',
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.seller.update', $seller->id), $payload);

    $response->assertRedirect(route('admin.seller.update', $seller->id));

    $this->assertDatabaseHas('sellers', [
        'id' => $seller->id,
        'email' => 'updated.seller@example.com',
        'phone' => '8100000004',
    ]);
});

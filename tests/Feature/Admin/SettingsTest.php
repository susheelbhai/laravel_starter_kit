<?php

use App\Models\Admin;
use App\Models\Setting;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.settings@example.com',
            'phone' => '9000000801',
            'password' => 'password',
        ]);
    });

    Setting::unguarded(function () {
        Setting::create(['id' => 1]);
    });
});

test('admin can view settings pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.settings.general'))
        ->assertOk();
});

test('admin can update general settings', function () {
    $payload = [
        'app_name' => 'Test App',
        'phone' => '1234567890',
        'whatsapp' => '1234567890',
    ];

    $this->actingAs($this->admin, 'admin')
        ->patch('/admin/setting/general', $payload)
        ->assertRedirect(route('admin.dashboard'));

    $this->assertDatabaseHas('settings', [
        'id' => 1,
        'app_name' => 'Test App',
    ]);
});

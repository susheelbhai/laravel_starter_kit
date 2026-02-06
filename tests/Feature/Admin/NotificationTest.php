<?php

use App\Models\Admin;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.notifications@example.com',
            'phone' => '9000001001',
            'password' => 'password',
        ]);
    });
});

test('admin can view notifications', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.notification.index'))
        ->assertOk();
});

test('admin can open notification links', function () {
    $notification = $this->admin->notifications()->create([
        'id' => (string) Str::uuid(),
        'type' => 'test',
        'data' => ['url' => '/admin'],
        'read_at' => null,
    ]);

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.notification.show', $notification->id))
        ->assertRedirect('/admin');
});

<?php

use App\Models\Admin;
use App\Models\Newsletter;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.newsletter@example.com',
            'phone' => '9000000601',
            'password' => 'password',
        ]);
    });
});

test('admin can view newsletters', function () {
    Newsletter::unguarded(function () {
        Newsletter::create([
            'email' => 'subscriber@example.com',
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.newsletter.index'))
        ->assertOk();
});

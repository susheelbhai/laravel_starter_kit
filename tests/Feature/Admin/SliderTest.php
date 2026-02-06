<?php

use App\Models\Admin;
use App\Models\Slider1;
use Illuminate\Support\Facades\View;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.slider@example.com',
            'phone' => '9000001201',
            'password' => 'password',
        ]);
    });

    Slider1::unguarded(function () {
        Slider1::create([
            'heading1' => 'Slider',
            'is_active' => true,
        ]);
    });
});

test('admin can view legacy slider index when view exists', function () {
    if (! View::exists('separate.admin.resources.slider.index')) {
        $this->markTestSkipped('Legacy slider view not present.');
    }

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.slider.index'))
        ->assertOk();
});

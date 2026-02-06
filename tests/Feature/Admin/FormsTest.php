<?php

use App\Models\Admin;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.forms@example.com',
            'phone' => '9000000901',
            'password' => 'password',
        ]);
    });
});

test('admin can view form pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.simple'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.editor'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.date'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.select'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.file'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.image'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.forms.wizard'))
        ->assertOk();
});

test('admin can update and submit wizard form', function () {
    $payload = [
        'field' => 'basic_details',
        'name' => 'Wizard User',
        'email' => 'wizard@example.com',
        'phone' => '1234567890',
        'address1' => 'Street',
        'city' => 'City',
        'state' => 'State',
        'pin_code' => '123456',
        'country' => 'Country',
    ];

    $this->actingAs($this->admin, 'admin')
        ->from(route('admin.forms.wizard'))
        ->patch(route('admin.forms.wizard.partial_update'), $payload)
        ->assertRedirect(route('admin.forms.wizard'));

    $this->actingAs($this->admin, 'admin')
        ->patch(route('admin.forms.wizard.submit'), [
            'field' => 'basic_details',
        ])
        ->assertRedirect(route('admin.dashboard'));
});

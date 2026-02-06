<?php

use App\Models\Admin;
use App\Notifications\Auth\Admin\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;

test('admin reset password link screen can be rendered', function () {
    $this->get(route('admin.password.request'))
        ->assertOk();
});

test('admin reset password link can be requested', function () {
    Notification::fake();

    $admin = Admin::factory()->create();

    $this->post(route('admin.password.email'), ['email' => $admin->email]);

    Notification::assertSentTo($admin, ResetPasswordNotification::class);
});

test('admin reset password screen can be rendered', function () {
    Notification::fake();

    $admin = Admin::factory()->create();

    $this->post(route('admin.password.email'), ['email' => $admin->email]);

    Notification::assertSentTo($admin, ResetPasswordNotification::class, function ($notification) {
        $this->get(route('admin.password.reset', $notification->token))
            ->assertOk();

        return true;
    });
});

test('admin password can be reset with valid token', function () {
    Notification::fake();

    $admin = Admin::factory()->create();

    $this->post(route('admin.password.email'), ['email' => $admin->email]);

    Notification::assertSentTo($admin, ResetPasswordNotification::class, function ($notification) use ($admin) {
        $response = $this->post(route('admin.password.store'), [
            'token' => $notification->token,
            'email' => $admin->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.login'));

        return true;
    });
});

test('admin password cannot be reset with invalid token', function () {
    $admin = Admin::factory()->create();

    $response = $this->post(route('admin.password.store'), [
        'token' => 'invalid-token',
        'email' => $admin->email,
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ]);

    $response->assertSessionHasErrors('email');
});

<?php

use App\Models\Partner;
use App\Notifications\Auth\Partner\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;

test('partner reset password link screen can be rendered', function () {
    $this->get(route('partner.password.request'))
        ->assertOk();
});

test('partner reset password link can be requested', function () {
    Notification::fake();

    $partner = Partner::factory()->create();

    $this->post(route('partner.password.email'), ['email' => $partner->email]);

    Notification::assertSentTo($partner, ResetPasswordNotification::class);
});

test('partner reset password screen can be rendered', function () {
    Notification::fake();

    $partner = Partner::factory()->create();

    $this->post(route('partner.password.email'), ['email' => $partner->email]);

    Notification::assertSentTo($partner, ResetPasswordNotification::class, function ($notification) {
        $this->get(route('partner.password.reset', $notification->token))
            ->assertOk();

        return true;
    });
});

test('partner password can be reset with valid token', function () {
    Notification::fake();

    $partner = Partner::factory()->create();

    $this->post(route('partner.password.email'), ['email' => $partner->email]);

    Notification::assertSentTo($partner, ResetPasswordNotification::class, function ($notification) use ($partner) {
        $response = $this->post(route('partner.password.store'), [
            'token' => $notification->token,
            'email' => $partner->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('partner.login'));

        return true;
    });
});

test('partner password cannot be reset with invalid token', function () {
    $partner = Partner::factory()->create();

    $response = $this->post(route('partner.password.store'), [
        'token' => 'invalid-token',
        'email' => $partner->email,
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ]);

    $response->assertSessionHasErrors('email');
});

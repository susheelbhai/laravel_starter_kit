<?php

use App\Models\Seller;
use App\Notifications\Auth\Seller\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;

function makeSellerForReset(array $overrides = []): Seller
{
    return Seller::unguarded(function () use ($overrides) {
        return Seller::create(array_merge([
            'name' => 'Seller User',
            'email' => 'seller.reset@example.com',
            'password' => 'password',
        ], $overrides));
    });
}

test('seller reset password link screen can be rendered', function () {
    $this->get(route('seller.password.request'))
        ->assertOk();
});

test('seller reset password link can be requested', function () {
    Notification::fake();

    $seller = makeSellerForReset(['email' => 'seller.reset.request@example.com']);

    $this->post(route('seller.password.email'), ['email' => $seller->email]);

    Notification::assertSentTo($seller, ResetPasswordNotification::class);
});

test('seller reset password screen can be rendered', function () {
    Notification::fake();

    $seller = makeSellerForReset(['email' => 'seller.reset.view@example.com']);

    $this->post(route('seller.password.email'), ['email' => $seller->email]);

    Notification::assertSentTo($seller, ResetPasswordNotification::class, function ($notification) {
        $this->get(route('seller.password.reset', $notification->token))
            ->assertOk();

        return true;
    });
});

test('seller password can be reset with valid token', function () {
    Notification::fake();

    $seller = makeSellerForReset(['email' => 'seller.reset.valid@example.com']);

    $this->post(route('seller.password.email'), ['email' => $seller->email]);

    Notification::assertSentTo($seller, ResetPasswordNotification::class, function ($notification) use ($seller) {
        $response = $this->post(route('seller.password.store'), [
            'token' => $notification->token,
            'email' => $seller->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('seller.login'));

        return true;
    });
});

test('seller password cannot be reset with invalid token', function () {
    $seller = makeSellerForReset(['email' => 'seller.reset.invalid@example.com']);

    $response = $this->post(route('seller.password.store'), [
        'token' => 'invalid-token',
        'email' => $seller->email,
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ]);

    $response->assertSessionHasErrors('email');
});

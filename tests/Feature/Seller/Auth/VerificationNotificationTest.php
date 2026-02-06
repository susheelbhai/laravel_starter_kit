<?php

use App\Models\Seller;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

test('sends seller verification notification', function () {
    Notification::fake();

    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller User',
            'email' => 'seller.notify@example.com',
            'password' => 'password',
            'email_verified_at' => null,
        ]);
    });

    $this->actingAs($seller, 'seller')
        ->post(route('seller.verification.send'))
        ->assertSessionHas('status', 'verification-link-sent');

    Notification::assertSentTo($seller, VerifyEmail::class);
});

test('does not send seller verification notification if email is verified', function () {
    Notification::fake();

    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller User',
            'email' => 'seller.notify.verified@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    });

    $this->actingAs($seller, 'seller')
        ->post(route('seller.verification.send'))
        ->assertRedirect(route('dashboard', absolute: false));

    Notification::assertNothingSent();
});

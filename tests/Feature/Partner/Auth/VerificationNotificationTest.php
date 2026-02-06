<?php

use App\Models\Partner;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

test('sends partner verification notification', function () {
    Notification::fake();

    $partner = Partner::factory()->create(['email_verified_at' => null]);

    $this->actingAs($partner, 'partner')
        ->post(route('partner.verification.send'))
        ->assertSessionHas('status', 'verification-link-sent');

    Notification::assertSentTo($partner, VerifyEmail::class);
});

test('does not send partner verification notification if email is verified', function () {
    Notification::fake();

    $partner = Partner::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($partner, 'partner')
        ->post(route('partner.verification.send'))
        ->assertRedirect(route('dashboard', absolute: false));

    Notification::assertNothingSent();
});

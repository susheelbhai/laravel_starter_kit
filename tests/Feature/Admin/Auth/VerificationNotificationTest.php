<?php

use App\Models\Admin;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

test('sends admin verification notification', function () {
    Notification::fake();

    $admin = Admin::factory()->create(['email_verified_at' => null]);

    $this->actingAs($admin, 'admin')
        ->post(route('admin.verification.send'))
        ->assertSessionHas('status', 'verification-link-sent');

    Notification::assertSentTo($admin, VerifyEmail::class);
});

test('does not send admin verification notification if email is verified', function () {
    Notification::fake();

    $admin = Admin::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($admin, 'admin')
        ->post(route('admin.verification.send'))
        ->assertRedirect(route('dashboard', absolute: false));

    Notification::assertNothingSent();
});

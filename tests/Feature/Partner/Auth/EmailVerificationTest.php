<?php

use App\Models\Partner;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia as Assert;

test('partner email verification screen can be rendered', function () {
    $partner = Partner::factory()->create(['email_verified_at' => null]);

    $response = $this->actingAs($partner, 'partner')
        ->get(route('partner.verification.notice'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('partner/auth/verify-email')
    );
});

test('partner email can be verified', function () {
    $partner = Partner::factory()->create(['email_verified_at' => null]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'partner.verification.verify',
        now()->addMinutes(60),
        ['id' => $partner->id, 'hash' => sha1($partner->email)]
    );

    $response = $this->actingAs($partner, 'partner')->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($partner->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('partner email is not verified with invalid hash', function () {
    $partner = Partner::factory()->create(['email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute(
        'partner.verification.verify',
        now()->addMinutes(60),
        ['id' => $partner->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($partner, 'partner')->get($verificationUrl);

    expect($partner->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('partner email is not verified with invalid user id', function () {
    $partner = Partner::factory()->create(['email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute(
        'partner.verification.verify',
        now()->addMinutes(60),
        ['id' => 123, 'hash' => sha1($partner->email)]
    );

    $this->actingAs($partner, 'partner')->get($verificationUrl);

    expect($partner->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('verified partner is redirected to dashboard from verification prompt', function () {
    $partner = Partner::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($partner, 'partner')
        ->get(route('partner.verification.notice'))
        ->assertRedirect(route('dashboard', absolute: false));
});

test('already verified partner visiting verification link is redirected without firing event again', function () {
    $partner = Partner::factory()->create(['email_verified_at' => now()]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'partner.verification.verify',
        now()->addMinutes(60),
        ['id' => $partner->id, 'hash' => sha1($partner->email)]
    );

    $this->actingAs($partner, 'partner')->get($verificationUrl)
        ->assertRedirect(route('dashboard', absolute: false).'?verified=1');

    Event::assertNotDispatched(Verified::class);
    expect($partner->fresh()->hasVerifiedEmail())->toBeTrue();
});

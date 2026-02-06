<?php

use App\Models\Seller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia as Assert;

function makeSellerForVerification(array $overrides = []): Seller
{
    return Seller::unguarded(function () use ($overrides) {
        return Seller::create(array_merge([
            'name' => 'Seller User',
            'email' => 'seller.verify@example.com',
            'password' => 'password',
            'email_verified_at' => null,
        ], $overrides));
    });
}

test('seller email verification screen can be rendered', function () {
    $seller = makeSellerForVerification();

    $response = $this->actingAs($seller, 'seller')
        ->get(route('seller.verification.notice'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('seller/auth/verify-email')
    );
});

test('seller email can be verified', function () {
    $seller = makeSellerForVerification(['email' => 'seller.verify.link@example.com']);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'seller.verification.verify',
        now()->addMinutes(60),
        ['id' => $seller->id, 'hash' => sha1($seller->email)]
    );

    $response = $this->actingAs($seller, 'seller')->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($seller->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('seller email is not verified with invalid hash', function () {
    $seller = makeSellerForVerification(['email' => 'seller.invalid.hash@example.com']);

    $verificationUrl = URL::temporarySignedRoute(
        'seller.verification.verify',
        now()->addMinutes(60),
        ['id' => $seller->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($seller, 'seller')->get($verificationUrl);

    expect($seller->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('seller email is not verified with invalid user id', function () {
    $seller = makeSellerForVerification(['email' => 'seller.invalid.user@example.com']);

    $verificationUrl = URL::temporarySignedRoute(
        'seller.verification.verify',
        now()->addMinutes(60),
        ['id' => 123, 'hash' => sha1($seller->email)]
    );

    $this->actingAs($seller, 'seller')->get($verificationUrl);

    expect($seller->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('verified seller is redirected to dashboard from verification prompt', function () {
    $seller = makeSellerForVerification([
        'email' => 'seller.verified@example.com',
        'email_verified_at' => now(),
    ]);

    $this->actingAs($seller, 'seller')
        ->get(route('seller.verification.notice'))
        ->assertRedirect(route('dashboard', absolute: false));
});

test('already verified seller visiting verification link is redirected without firing event again', function () {
    $seller = makeSellerForVerification([
        'email' => 'seller.verified.link@example.com',
        'email_verified_at' => now(),
    ]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'seller.verification.verify',
        now()->addMinutes(60),
        ['id' => $seller->id, 'hash' => sha1($seller->email)]
    );

    $this->actingAs($seller, 'seller')->get($verificationUrl)
        ->assertRedirect(route('dashboard', absolute: false).'?verified=1');

    Event::assertNotDispatched(Verified::class);
    expect($seller->fresh()->hasVerifiedEmail())->toBeTrue();
});

<?php

use App\Models\Admin;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia as Assert;

test('admin email verification screen can be rendered', function () {
    $admin = Admin::factory()->create(['email_verified_at' => null]);

    $response = $this->actingAs($admin, 'admin')
        ->get(route('admin.verification.notice'));

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('admin/auth/verify-email')
    );
});

test('admin email can be verified', function () {
    $admin = Admin::factory()->create(['email_verified_at' => null]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'admin.verification.verify',
        now()->addMinutes(60),
        ['id' => $admin->id, 'hash' => sha1($admin->email)]
    );

    $response = $this->actingAs($admin, 'admin')->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($admin->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('admin email is not verified with invalid hash', function () {
    $admin = Admin::factory()->create(['email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute(
        'admin.verification.verify',
        now()->addMinutes(60),
        ['id' => $admin->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($admin, 'admin')->get($verificationUrl);

    expect($admin->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('admin email is not verified with invalid user id', function () {
    $admin = Admin::factory()->create(['email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute(
        'admin.verification.verify',
        now()->addMinutes(60),
        ['id' => 123, 'hash' => sha1($admin->email)]
    );

    $this->actingAs($admin, 'admin')->get($verificationUrl);

    expect($admin->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('verified admin is redirected to dashboard from verification prompt', function () {
    $admin = Admin::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.verification.notice'))
        ->assertRedirect(route('dashboard', absolute: false));
});

test('already verified admin visiting verification link is redirected without firing event again', function () {
    $admin = Admin::factory()->create(['email_verified_at' => now()]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'admin.verification.verify',
        now()->addMinutes(60),
        ['id' => $admin->id, 'hash' => sha1($admin->email)]
    );

    $this->actingAs($admin, 'admin')->get($verificationUrl)
        ->assertRedirect(route('dashboard', absolute: false).'?verified=1');

    Event::assertNotDispatched(Verified::class);
    expect($admin->fresh()->hasVerifiedEmail())->toBeTrue();
});

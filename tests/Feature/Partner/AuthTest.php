<?php

test('partner auth guest routes respond', function (string $method, string $path, int $expectedStatus) {
    $response = $this->call($method, $path);

    $response->assertStatus($expectedStatus);
})->with('partnerAuthGuestRoutes');

test('partner auth guest posts redirect', function (string $path, array $payload) {
    $response = $this->post($path, $payload);

    $response->assertStatus(302);
})->with('partnerAuthGuestPosts');

dataset('partnerAuthGuestRoutes', [
    ['GET', '/partner/login', 200],
    ['GET', '/partner/forgot-password', 200],
    ['GET', '/partner/reset-password/test-token', 200],
    ['GET', '/partner/auth/invalid', 404],
    ['GET', '/partner/auth/invalid/callback', 404],
]);

dataset('partnerAuthGuestPosts', [
    ['/partner/login', []],
    ['/partner/forgot-password', ['email' => 'not-an-email']],
    ['/partner/reset-password', [
        'token' => 'invalid-token',
        'email' => 'not-an-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]],
]);

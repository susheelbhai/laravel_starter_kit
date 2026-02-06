<?php

test('seller auth guest routes respond', function (string $method, string $path, int $expectedStatus) {
    $response = $this->call($method, $path);

    $response->assertStatus($expectedStatus);
})->with('sellerAuthGuestRoutes');

test('seller auth guest posts redirect', function (string $path, array $payload) {
    $response = $this->post($path, $payload);

    $response->assertStatus(302);
})->with('sellerAuthGuestPosts');

dataset('sellerAuthGuestRoutes', [
    ['GET', '/seller/login', 200],
    ['GET', '/seller/forgot-password', 200],
    ['GET', '/seller/reset-password/test-token', 200],
    ['GET', '/seller/auth/invalid', 404],
    ['GET', '/seller/auth/invalid/callback', 404],
]);

dataset('sellerAuthGuestPosts', [
    ['/seller/login', []],
    ['/seller/forgot-password', ['email' => 'not-an-email']],
    ['/seller/reset-password', [
        'token' => 'invalid-token',
        'email' => 'not-an-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]],
]);

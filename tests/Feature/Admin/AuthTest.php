<?php

test('admin auth guest routes respond', function (string $method, string $path, int $expectedStatus) {
    $response = $this->call($method, $path);

    $response->assertStatus($expectedStatus);
})->with('adminAuthGuestRoutes');

test('admin auth guest posts redirect', function (string $path, array $payload) {
    $response = $this->post($path, $payload);

    $response->assertStatus(302);
})->with('adminAuthGuestPosts');

dataset('adminAuthGuestRoutes', [
    ['GET', '/admin/login', 200],
    ['GET', '/admin/forgot-password', 200],
    ['GET', '/admin/reset-password/test-token', 200],
    ['GET', '/admin/auth/invalid', 404],
    ['GET', '/admin/auth/invalid/callback', 404],
]);

dataset('adminAuthGuestPosts', [
    ['/admin/login', []],
    ['/admin/forgot-password', ['email' => 'not-an-email']],
    ['/admin/reset-password', [
        'token' => 'invalid-token',
        'email' => 'not-an-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]],
]);

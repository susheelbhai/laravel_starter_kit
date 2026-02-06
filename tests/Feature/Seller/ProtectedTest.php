<?php

use App\Models\Seller;

function sellerRouteUrl(string $route, array $parameters = []): string
{
    if (str_starts_with($route, '/')) {
        return $route;
    }

    return route($route, $parameters, false);
}

test('seller guests are redirected from protected routes', function (string $method, string $route, array $parameters) {
    $url = sellerRouteUrl($route, $parameters);

    $response = $this->call($method, $url);

    $response->assertRedirect(route('seller.login', absolute: false));
})->with('sellerProtectedRoutes');

test('seller can access dashboard and notifications', function () {
    $seller = Seller::unguarded(function () {
        return Seller::create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => 'password',
        ]);
    });

    $this->actingAs($seller, 'seller')
        ->get(route('seller.dashboard'))
        ->assertOk();

    $this->actingAs($seller, 'seller')
        ->get(route('seller.notification.index'))
        ->assertOk();
});

dataset('sellerProtectedRoutes', [
    ['GET', 'seller.dashboard', []],
    ['GET', 'seller.notification.index', []],
    ['GET', 'seller.notification.show', [1]],

    ['GET', 'seller.profile.edit', []],
    ['PATCH', 'seller.profile.update', []],
    ['DELETE', 'seller.profile.destroy', []],
    ['GET', 'seller.password.edit', []],
    ['PUT', 'seller.password.update', []],
    ['GET', 'seller.appearance.edit', []],
    ['GET', 'seller.two-factor.show', []],

    ['GET', 'seller.verification.notice', []],
    ['GET', 'seller.verification.verify', ['id' => 1, 'hash' => sha1('test@example.com')]],
    ['POST', 'seller.verification.send', []],
    ['GET', 'seller.password.confirm', []],
    ['PUT', '/seller/password', []],
    ['POST', 'seller.logout', []],

    ['GET', '/seller/settings', []],
    ['GET', '/seller/settings/profile', []],
    ['PATCH', '/seller/settings/profile', []],
    ['DELETE', '/seller/settings/profile', []],
    ['GET', '/seller/settings/password', []],
    ['PUT', '/seller/settings/password', []],
    ['GET', '/seller/settings/appearance', []],
    ['GET', '/seller/settings/two-factor', []],
]);

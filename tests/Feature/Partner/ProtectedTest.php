<?php

use App\Models\Partner;

function partnerRouteUrl(string $route, array $parameters = []): string
{
    if (str_starts_with($route, '/')) {
        return $route;
    }

    return route($route, $parameters, false);
}

test('partner guests are redirected from protected routes', function (string $method, string $route, array $parameters) {
    $url = partnerRouteUrl($route, $parameters);

    $response = $this->call($method, $url);

    $response->assertRedirect(route('partner.login', absolute: false));
})->with('partnerProtectedRoutes');

test('partner can access dashboard and notifications', function () {
    $partner = Partner::unguarded(function () {
        return Partner::create([
            'name' => 'Partner User',
            'email' => 'partner@example.com',
            'password' => 'password',
        ]);
    });

    $this->actingAs($partner, 'partner')
        ->get(route('partner.dashboard'))
        ->assertOk();

    $this->actingAs($partner, 'partner')
        ->get(route('partner.notification.index'))
        ->assertOk();
});

dataset('partnerProtectedRoutes', [
    ['GET', 'partner.dashboard', []],
    ['GET', 'partner.notification.index', []],
    ['GET', 'partner.notification.show', [1]],

    ['GET', 'partner.profile.edit', []],
    ['PATCH', 'partner.profile.update', []],
    ['DELETE', 'partner.profile.destroy', []],
    ['GET', 'partner.password.edit', []],
    ['PUT', 'partner.password.update', []],
    ['GET', 'partner.appearance.edit', []],
    ['GET', 'partner.two-factor.show', []],

    ['GET', 'partner.verification.notice', []],
    ['GET', 'partner.verification.verify', ['id' => 1, 'hash' => sha1('test@example.com')]],
    ['POST', 'partner.verification.send', []],
    ['GET', 'partner.password.confirm', []],
    ['PUT', '/partner/password', []],
    ['POST', 'partner.logout', []],

    ['GET', '/partner/settings', []],
    ['GET', '/partner/settings/profile', []],
    ['PATCH', '/partner/settings/profile', []],
    ['DELETE', '/partner/settings/profile', []],
    ['GET', '/partner/settings/password', []],
    ['PUT', '/partner/settings/password', []],
    ['GET', '/partner/settings/appearance', []],
    ['GET', '/partner/settings/two-factor', []],
]);

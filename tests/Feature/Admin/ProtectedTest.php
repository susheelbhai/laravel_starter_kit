<?php

use App\Models\Admin;

function adminRouteUrl(string $route, array $parameters = []): string
{
    if (str_starts_with($route, '/')) {
        return $route;
    }

    return route($route, $parameters, false);
}

function adminResourceRoutes(string $resource, bool $hasShow = true, bool $hasDestroy = true): array
{
    $routes = [
        ['GET', "admin.{$resource}.index", []],
        ['GET', "admin.{$resource}.create", []],
        ['POST', "admin.{$resource}.store", []],
        ['GET', "admin.{$resource}.edit", [1]],
        ['PUT', "admin.{$resource}.update", [1]],
    ];

    if ($hasShow) {
        $routes[] = ['GET', "admin.{$resource}.show", [1]];
    }

    if ($hasDestroy) {
        $routes[] = ['DELETE', "admin.{$resource}.destroy", [1]];
    }

    return $routes;
}

test('admin guests are redirected from protected routes', function (string $method, string $route, array $parameters) {
    $url = adminRouteUrl($route, $parameters);

    $response = $this->call($method, $url);

    $response->assertRedirect(route('admin.login', absolute: false));
})->with('adminProtectedRoutes');

test('admin can access dashboard and notifications', function () {
    $admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
    });

    $this->actingAs($admin, 'admin')
        ->get(route('admin.dashboard'))
        ->assertOk();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.notification.index'))
        ->assertOk();
});

dataset('adminProtectedRoutes', array_merge([
    ['GET', '/admin/profile', []],
    ['PATCH', '/admin/profile', []],
    ['DELETE', '/admin/profile', []],
    ['GET', 'admin.dashboard', []],
    ['GET', 'admin.notification.index', []],
    ['GET', 'admin.notification.show', [1]],

    ['GET', 'admin.settings.general', []],
    ['PATCH', '/admin/setting/general', []],

    ['GET', 'admin.forms.simple', []],
    ['GET', 'admin.forms.editor', []],
    ['GET', 'admin.forms.date', []],
    ['GET', 'admin.forms.select', []],
    ['GET', 'admin.forms.file', []],
    ['GET', 'admin.forms.image', []],
    ['PATCH', 'admin.forms.simple.store', []],
    ['PATCH', 'admin.forms.editor.store', []],
    ['GET', 'admin.forms.wizard', []],
    ['PATCH', 'admin.forms.wizard.partial_update', []],
    ['PATCH', 'admin.forms.wizard.submit', []],

    ['GET', 'admin.pages.authPage', []],
    ['PATCH', 'admin.pages.updateAuthPage', []],
    ['GET', 'admin.pages.homePage', []],
    ['PATCH', 'admin.pages.updateHomePage', []],
    ['GET', 'admin.pages.aboutPage', []],
    ['PATCH', 'admin.pages.updateAboutPage', []],
    ['GET', 'admin.pages.contactPage', []],
    ['PATCH', 'admin.pages.updateContactPage', []],
    ['GET', 'admin.pages.tncPage', []],
    ['PATCH', 'admin.pages.updateTncPage', []],
    ['GET', 'admin.pages.privacyPage', []],
    ['PATCH', 'admin.pages.updatePrivacyPage', []],
    ['GET', 'admin.pages.refundPage', []],
    ['PATCH', 'admin.pages.updateRefundPage', []],

    ['GET', 'admin.newsletter.index', []],

    ['GET', 'admin.password.edit', []],
    ['PUT', 'admin.password.update', []],
    ['GET', 'admin.appearance.edit', []],
    ['GET', 'admin.two-factor.show', []],

    ['GET', 'admin.verification.notice', []],
    ['GET', 'admin.verification.verify', ['id' => 1, 'hash' => sha1('test@example.com')]],
    ['POST', 'admin.verification.send', []],
    ['GET', 'admin.password.confirm', []],
    ['PUT', '/admin/password', []],
    ['POST', 'admin.logout', []],

    ['GET', '/admin/settings', []],
    ['GET', '/admin/settings/profile', []],
    ['PATCH', '/admin/settings/profile', []],
    ['DELETE', '/admin/settings/profile', []],
    ['GET', '/admin/settings/password', []],
    ['PUT', '/admin/settings/password', []],
    ['GET', '/admin/settings/appearance', []],
    ['GET', '/admin/settings/two-factor', []],
],
    adminResourceRoutes('admin'),
    adminResourceRoutes('role'),
    adminResourceRoutes('permission'),
    adminResourceRoutes('slider1', false, false),
    adminResourceRoutes('slider'),
    adminResourceRoutes('partner'),
    adminResourceRoutes('seller'),
    adminResourceRoutes('user'),
    adminResourceRoutes('userQuery'),
    adminResourceRoutes('productEnquiry'),
    adminResourceRoutes('important_links'),
    adminResourceRoutes('team'),
    adminResourceRoutes('testimonial'),
    adminResourceRoutes('portfolio'),
    adminResourceRoutes('project'),
    adminResourceRoutes('service'),
    adminResourceRoutes('blog'),
    adminResourceRoutes('faq'),
    adminResourceRoutes('product_category'),
    adminResourceRoutes('product')));

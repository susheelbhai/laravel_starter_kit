<?php

use App\Models\Admin;
use App\Models\User;

test('all admin pages render without errors', function () {
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin');

    $routes = [
        'admin.dashboard',
        'admin.admins.index',
        'admin.users.index',
        'admin.roles.index',
        'admin.permissions.index',
        'admin.partners.index',
        'admin.sellers.index',
        'admin.products.index',
        'admin.product_categories.index',
        'admin.product_enquiries.index',
        'admin.user_queries.index',
        'admin.blogs.index',
        'admin.portfolios.index',
        'admin.projects.index',
        'admin.services.index',
        'admin.teams.index',
        'admin.testimonials.index',
        'admin.galleries.index',
        'admin.faqs.index',
        'admin.important_links.index',
    ];

    foreach ($routes as $route) {
        if (!\Illuminate\Support\Facades\Route::has($route)) {
            continue;
        }

        $response = $this->get(route($route));
        $response->assertOk("Route {$route} failed to render");
    }
})->group('inertia');

test('user dashboard renders without errors', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
})->group('inertia');

test('guest pages render without errors', function () {
    $routes = [
        'home',
        'login',
        'register',
    ];

    foreach ($routes as $route) {
        if (!\Illuminate\Support\Facades\Route::has($route)) {
            continue;
        }

        $response = $this->get(route($route));
        $response->assertStatus(200);
    }
})->group('inertia');

test('inertia responses include required props', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    
    $response->assertOk();
    
    // Check that Inertia props are present
    $content = $response->getContent();
    expect($content)->toContain('data-page');
})->group('inertia');

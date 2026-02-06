<?php

use App\Models\Visitor;

test('visitor count api returns totals', function () {
    Visitor::unguarded(function () {
        Visitor::create([
            'ip_address' => '127.0.0.1',
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        Visitor::create([
            'ip_address' => '127.0.0.2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    });

    $response = $this->get('/api/visitors/count');

    $response->assertOk();
    $response->assertJson([
        'total' => 2,
        'today' => 1,
    ]);
});

test('storage link route responds', function () {
    if (PHP_OS_FAMILY === 'Windows') {
        $this->markTestSkipped('Symlink creation is skipped on Windows.');
    }

    $response = $this->get('/link-storage');

    $response->assertOk();
    $response->assertSee('link', false);
});

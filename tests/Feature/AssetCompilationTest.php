<?php

test('vite manifest exists after build', function () {
    $manifestPath = public_path('build/manifest.json');
    
    if (!file_exists($manifestPath)) {
        $this->markTestSkipped('Build assets not found. Run "npm run build" first.');
    }

    expect(file_exists($manifestPath))->toBeTrue();
    
    $manifest = json_decode(file_get_contents($manifestPath), true);
    expect($manifest)->toBeArray();
    expect($manifest)->not->toBeEmpty();
})->group('frontend', 'assets');

test('critical JavaScript files are compiled', function () {
    $manifestPath = public_path('build/manifest.json');
    
    if (!file_exists($manifestPath)) {
        $this->markTestSkipped('Build assets not found. Run "npm run build" first.');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
    
    // Check for main app entry point
    $hasAppJs = collect($manifest)->contains(function ($value, $key) {
        return str_contains($key, 'resources/js/app.tsx') || 
               str_contains($key, 'resources/js/app.ts') ||
               str_contains($key, 'resources/js/app.jsx');
    });

    expect($hasAppJs)->toBeTrue('Main application JavaScript file not found in build manifest');
})->group('frontend', 'assets');

test('CSS files are compiled', function () {
    $manifestPath = public_path('build/manifest.json');
    
    if (!file_exists($manifestPath)) {
        $this->markTestSkipped('Build assets not found. Run "npm run build" first.');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
    
    // Check if any CSS files exist in manifest
    $hasCss = collect($manifest)->contains(function ($value) {
        return isset($value['css']) && !empty($value['css']);
    });

    expect($hasCss)->toBeTrue('No CSS files found in build manifest');
})->group('frontend', 'assets');

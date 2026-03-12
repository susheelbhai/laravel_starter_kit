<?php

use Illuminate\Support\Facades\File;

test('all TypeScript/TSX files have valid imports', function () {
    $jsPath = base_path('resources/js');
    
    if (!is_dir($jsPath)) {
        $this->markTestSkipped('JavaScript directory not found');
    }

    $files = File::allFiles($jsPath);
    $errors = [];

    foreach ($files as $file) {
        if (!in_array($file->getExtension(), ['ts', 'tsx', 'js', 'jsx'])) {
            continue;
        }

        $content = file_get_contents($file->getPathname());
        $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());

        // Check for common import issues
        
        // 1. Check for imports from deleted button.tsx in components root
        if (preg_match('/from [\'"]@\/components\/button[\'"]/', $content)) {
            $errors[] = "{$relativePath}: Still importing from old @/components/button (should be @/components/ui/button)";
        }

        // 2. Check for missing file extensions in relative imports (common issue)
        if (preg_match('/from [\'"]\.\.?\/[^\'"]+(\.tsx|\.ts|\.jsx|\.js)[\'"]/', $content)) {
            $errors[] = "{$relativePath}: Import includes file extension (TypeScript doesn't need extensions in imports)";
        }

        // 3. Check for imports with wrong path separators (Windows issue)
        if (preg_match('/from [\'"][^\'\"]*\\\\[^\'\"]*[\'"]/', $content)) {
            $errors[] = "{$relativePath}: Import uses backslashes instead of forward slashes";
        }
    }

    if (!empty($errors)) {
        $this->fail("Import issues found:\n" . implode("\n", $errors));
    }

    expect($errors)->toBeEmpty();
})->group('frontend', 'imports');

test('no duplicate component definitions exist', function () {
    $jsPath = base_path('resources/js');
    
    if (!is_dir($jsPath)) {
        $this->markTestSkipped('JavaScript directory not found');
    }

    $componentFiles = [];
    $files = File::allFiles($jsPath);

    // Allowed duplicate patterns (multi-tenant structure)
    $allowedDuplicates = [
        'app-layout.tsx',
        'auth-layout.tsx',
        'side-menu.tsx',
        'confirm-password.tsx',
        'forgot-password.tsx',
        'login.tsx',
        'reset-password.tsx',
        'verify-email.tsx',
        'dashboard.tsx',
        'create.tsx',
        'edit.tsx',
        'index.tsx',
        'show.tsx',
        'about.tsx',
        'privacy.tsx',
        'refund.tsx',
        'tnc.tsx',
        'appearance.tsx',
        'password.tsx',
        'profile.tsx',
        'detail.tsx',
        'app-header-layout.tsx',
        'app-sidebar-layout.tsx',
        'auth-card-layout.tsx',
        'auth-simple-layout.tsx',
        'auth-split-layout.tsx',
        // Theme-specific components
        'app-logo.tsx',
        'app-sidebar-header.tsx',
        'app-sidebar.tsx',
        'input-otp.tsx',
        'icon.tsx',
    ];

    foreach ($files as $file) {
        if (!in_array($file->getExtension(), ['tsx', 'jsx'])) {
            continue;
        }

        $filename = $file->getFilename();
        
        // Skip allowed duplicates
        if (in_array($filename, $allowedDuplicates)) {
            continue;
        }

        $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());

        if (!isset($componentFiles[$filename])) {
            $componentFiles[$filename] = [];
        }

        $componentFiles[$filename][] = $relativePath;
    }

    $duplicates = array_filter($componentFiles, fn($paths) => count($paths) > 1);

    if (!empty($duplicates)) {
        $messages = [];
        foreach ($duplicates as $filename => $paths) {
            $messages[] = "{$filename} exists in multiple locations:\n  - " . implode("\n  - ", $paths);
        }
        
        $this->fail("Duplicate component files found:\n" . implode("\n\n", $messages));
    }

    expect($duplicates)->toBeEmpty();
})->group('frontend', 'imports');

test('all component imports can be resolved', function () {
    $jsPath = base_path('resources/js');
    
    if (!is_dir($jsPath)) {
        $this->markTestSkipped('JavaScript directory not found');
    }

    $files = File::allFiles($jsPath);
    $errors = [];

    // Known missing files that are OK (generated or optional)
    $allowedMissing = [
        'routes',
        'routes/two-factor',
    ];

    foreach ($files as $file) {
        if (!in_array($file->getExtension(), ['ts', 'tsx', 'js', 'jsx'])) {
            continue;
        }

        $content = file_get_contents($file->getPathname());
        $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());

        // Extract all imports using @ alias
        preg_match_all('/from [\'"]@\/([^\'"]+)[\'"]/', $content, $matches);

        foreach ($matches[1] as $importPath) {
            // Skip allowed missing imports
            if (in_array($importPath, $allowedMissing)) {
                continue;
            }

            // Convert @ alias to actual path
            $actualPath = base_path('resources/js/' . $importPath);
            
            // Check with common extensions
            $extensions = ['', '.ts', '.tsx', '.js', '.jsx', '/index.ts', '/index.tsx', '/index.js', '/index.jsx'];
            $found = false;

            foreach ($extensions as $ext) {
                if (file_exists($actualPath . $ext)) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $errors[] = "{$relativePath}: Cannot resolve import '@/{$importPath}'";
            }
        }
    }

    if (!empty($errors)) {
        $this->fail("Unresolvable imports found:\n" . implode("\n", $errors));
    }

    expect($errors)->toBeEmpty();
})->group('frontend', 'imports');

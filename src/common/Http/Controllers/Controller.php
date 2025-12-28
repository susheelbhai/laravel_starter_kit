<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;

abstract class Controller
{
    protected function render(string $path, array $data = [], string $render_type = 'view')
    {
        $render_type = strtolower($render_type);
        if ($render_type === 'inertia') {
            $component = str_replace('.', '/', $path);
            return Inertia::render($component, $data);
        }
        // dd($render_type);
        return view($path, $data);
    }
}

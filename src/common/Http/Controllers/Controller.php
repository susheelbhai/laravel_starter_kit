<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;

abstract class Controller
{
    protected function render(string $path, array $data = [],  $render_type = null)
    {

        if ($render_type == null) {
            $render_type = config('app.render_type', 'blade');
        }
        $render_type = Str::lower($render_type);
        if ($render_type === 'inertia') {
            $component = str_replace('.', '/', $path);
            return Inertia::render($component, $data);
        }
        return view($path, $data);
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Helper', \App\Helpers\Helper::class);
        if (config('app.env') == 'production') {
            $this->app->usePublicPath(base_path('public_html'));
        }
    }

    public function boot(): void {
        
    }
}

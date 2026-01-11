<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Helper', \App\Helpers\Helper::class);
        if(config('app.env') == 'production'){
            $this->app->usePublicPath(base_path('public_html'));
        }
    }

    public function boot(): void
    {
        // if (config('app.env') == 'local') {
        //     Livewire::setScriptRoute(function ($handle) {
        //         return Route::get('/{custom_path_after_root_url}/livewire/livewire.js', $handle);
        //     });
        //     Livewire::setUpdateRoute(function ($handle) {
        //         return Route::post('/{custom_path_after_root_url}/livewire/update', $handle);
        //     });
        // }
    }
}

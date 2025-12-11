<?php

namespace Susheelbhai\StarterKit;

use Illuminate\Support\ServiceProvider;

class StarterKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'starter_kit');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPublishable();

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Susheelbhai\StarterKit\common\Commands\initial_settings::class,
                \Susheelbhai\StarterKit\common\Commands\final_settings::class,
            ]);
        }
    }

    public function registerPublishable()
    {
        $this->publishes([
            __dir__ . "/blade/Http" => app_path('/Http'),
            __dir__ . "/blade/Livewire" => app_path('/Livewire'),
            __dir__ . "/common/Http" => app_path('/Http'),
            __dir__ . "/common/Models" => app_path('/Models'),
            __dir__ . "/common/Notifications" => app_path('/Notifications'),
            __dir__ . "/common/Helpers" => app_path('/Helpers'),
            __dir__ . "/common/Events" => app_path('/Events'),
            __dir__ . "/common/Listeners" => app_path('/Listeners'),
            __dir__ . "/blade/Providers" => app_path('/Providers'),
            __dir__ . "/blade/View" => app_path('/View'),
            __dir__ . "/../database" => database_path('/'),
            __dir__ . "/../config" => config_path('/'),
            __dir__ . "/../routes" => base_path('/routes'),
            __DIR__ . '/../resources/themes' => base_path('resources/themes'),
            __DIR__ . '/../resources/views' => base_path('resources/views'),
            __DIR__ . '/../resources/common_views' => base_path('resources/views'),
            __DIR__ . '/../bootstrap' => base_path('bootstrap'),
            __dir__ . "/../assets/images" => storage_path('app/public/images'),
            __dir__ . "/../assets/css" => public_path('css'),
            __dir__ . "/../assets/js/common.js" => public_path('js/common.js')
        ], 'blade_starter_kit');

        $this->publishes([
            __dir__ . "/react/Http" => app_path('/Http'),
            // __dir__ . "/Livewire" => app_path('/Livewire'),
            __dir__ . "/common/Http" => app_path('/Http'),
            __dir__ . "/common/Models" => app_path('/Models'),
            __dir__ . "/common/Notifications" => app_path('/Notifications'),
            __dir__ . "/common/Helpers" => app_path('/Helpers'),
            __dir__ . "/common/Events" => app_path('/Events'),
            __dir__ . "/common/Listeners" => app_path('/Listeners'),
            __dir__ . "/react/Providers" => app_path('/Providers'),
            __dir__ . "/blade/View" => app_path('/View'),
            __dir__ . "/../database" => database_path('/'),
            __dir__ . "/../config" => config_path('/'),
            __dir__ . "/../routes" => base_path('/routes'),
            __DIR__ . '/../resources/css' => base_path('resources/css'),
            __DIR__ . '/../resources/js' => base_path('resources/js'),
            __DIR__ . '/../resources/react_views' => base_path('resources/views'),
            __DIR__ . '/../resources/common_views' => base_path('resources/views'),
            __DIR__ . '/../bootstrap' => base_path('bootstrap'),
            __dir__ . "/../assets/images" => storage_path('app/public/images'),
            __dir__ . "/../assets/css" => public_path('css'),
            __dir__ . "/../assets/themes/ck_editor" => public_path('themes/ck_editor')
        ], 'react_starter_kit');

        $this->publishes([
            __dir__ . "/../assets" => public_path('')
        ], 'starter_kit_themes');
    }
}

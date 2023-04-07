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
                \Susheelbhai\StarterKit\Commands\initial_settings::class,
            ]);
        }

    }

    public function registerPublishable()
    {
        $this->publishes([
            __dir__ . "/Rules" => app_path('/Rules'),
            __dir__ . "/Helpers" => app_path('/Helpers'),
            __dir__ . "/Http" => app_path('/Http'),
            __dir__ . "/Mail" => app_path('/Mail'),
            __dir__ . "/Models" => app_path('/Models'),
            __dir__ . "/Providers" => app_path('/Providers'),
            __dir__ . "/View" => app_path('/View'),
            __dir__ . "/../database" => database_path('/'),
            __dir__ . "/../config" => config_path('/'),
            __dir__ . "/../routes" => base_path('/routes'),
            __DIR__.'/../resources/views' => base_path('resources/views'),
            __dir__ . "/../assets/images" => public_path('storage/images'),
            __dir__ . "/../assets/css" => public_path('storage/css'),
            __dir__ . "/../assets/js" => public_path('storage/js')
        ], 'starter_kit');
        $this->publishes([
            __dir__ . "/../assets" => public_path('storage')
        ], 'starter_kit_themes');
    }
}

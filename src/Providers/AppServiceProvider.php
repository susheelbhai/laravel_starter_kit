<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') == 'production') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
        if (config('app.env') == 'testing') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
        if (config('app.env') == 'local') {
            $this->app->usePublicPath(base_path() . '/../public_html');
            $this->app->useStoragePath(base_path() . '/../public_html/storage');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        $settings = Setting::where('id', 1)->first();
        Config::set('settings', $settings);
    }
}

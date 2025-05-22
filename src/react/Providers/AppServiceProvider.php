<?php

namespace App\Providers;

use App\Models\ImportantLink;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Helper', \App\Helpers\Helper::class);
        
    }

    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::user(), // Default guard
                ];
            },
            'admin' => function () {
                return [
                    'user' => Auth::guard('admin')->user(), // Admin guard
                ];
            },
        ]);

        $settings = Setting::find(1); // or whatever logic you want
        $important_link = ImportantLink::latest()->get(); // or whatever logic you want
        config([
            'important_links' => $important_link,
        ]);
        if ($settings) {
            config([
                'app.name' => $settings->app_name,
                'app.favicon' => $settings->favicon,
                'app.dark_logo' => $settings->dark_logo,
                'app.light_logo' => $settings->light_logo,
                'app.email' => $settings->email,
                'app.phone' => $settings->phone,
                'app.facebook' => $settings->facebook,
                'app.twitter' => $settings->twitter,
                'app.instagram' => $settings->instagram,
                'app.linkedin' => $settings->linkedin,
                'app.address' => $settings->address,
            ]);
        }
        
    }
}

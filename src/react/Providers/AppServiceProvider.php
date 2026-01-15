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
        if(config('app.env') == 'production'){
            $this->app->usePublicPath(base_path('public_html'));
        }
    }

    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $unreadNotifications = $user ? $user->unreadNotifications()->take(10)->get()->map(function($n) { return $n->toArray(); }) : [];
                $unreadCount = $user ? count($unreadNotifications) : 0;
                return [
                    'user' => $user, // Default guard
                    'dashboard_url' => route('dashboard'),
                    'unread_notifications_count' => $unreadCount,
                    'unread_notifications' => $unreadNotifications,
                ];
            },
            'admin' => function () {
                /** @var \App\Models\Admin $user */
                $user = Auth::guard('admin')->user();
                $unreadNotifications = $user ? $user->unreadNotifications()->take(10)->get()->map(function($n) { return $n->toArray(); }) : [];
                $unreadCount = $user ? count($unreadNotifications) : 0;
                return [
                    'user' => $user, // Admin guard
                    'permissions' => $user?->getAllPermissions()->pluck('name'), 
                    'dashboard_url' => route('admin.dashboard'),
                    'unread_notifications_count' => $unreadCount,
                    'unread_notifications' => $unreadNotifications,
                ];
            },
            'partner' => function () {
                /** @var \App\Models\Partner $user */
                $user = Auth::guard('partner')->user();
                $unreadNotifications = $user ? $user->unreadNotifications()->take(10)->get()->map(function($n) { return $n->toArray(); }) : [];
                $unreadCount = $user ? count($unreadNotifications) : 0;
                return [
                    'user' => $user, // Partner guard
                    'permissions' => $user?->getAllPermissions()->pluck('name'), 
                    'dashboard_url' => route('partner.dashboard'),
                    'unread_notifications_count' => $unreadCount,
                    'unread_notifications' => $unreadNotifications,
                ];
            },
            'seller' => function () {
                /** @var \App\Models\Seller $user */
                $user = Auth::guard('seller')->user();
                $unreadNotifications = $user ? $user->unreadNotifications()->take(10)->get()->map(function($n) { return $n->toArray(); }) : [];
                $unreadCount = $user ? count($unreadNotifications) : 0;
                return [
                    'user' => $user, // Seller guard
                    'permissions' => $user?->getAllPermissions()->pluck('name'), 
                    'dashboard_url' => route('seller.dashboard'),
                    'unread_notifications_count' => $unreadCount,
                    'unread_notifications' => $unreadNotifications,
                ];
            },
        ]);

        
        $settings = Setting::find(1); 
        $important_link = ImportantLink::whereIsActive(1)->latest()->get(); 
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
                'app.youtube' => $settings->youtube,
                'app.whatsapp' => '91'.$settings->whatsapp,
                'app.address' => $settings->address,
            ]);
        }
        
        
        
    }
}

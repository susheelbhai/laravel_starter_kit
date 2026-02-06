<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\ImportantLink;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShareDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
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
                'app.square_dark_logo' => $settings->square_dark_logo,
                'app.square_light_logo' => $settings->square_light_logo,
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
        
        
        
        return $next($request);
    }
}

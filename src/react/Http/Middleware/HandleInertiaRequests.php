<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\PageAuth;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return [
            ...parent::share($request),
            'appData' => [
                'name' => config('app.name'),
                'favicon' => config('app.favicon'),
                'dark_logo' => config('app.dark_logo'),
                'light_logo' => config('app.light_logo'),
                'email' => config('app.email'),
                'phone' => config('app.phone'),
                'whatsapp' => config('app.whatsapp'),
                'facebook' => config('app.facebook'),
                'twitter' => config('app.twitter'),
                'instagram' => config('app.instagram'),
                'linkedin' => config('app.linkedin'),
                'youtube' => config('app.youtube'),
                'apiUrl' => config('app.url'),
                'address' => config('app.address'),
            ],
            'important_links' => config('important_links'),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
                'settings' => PageAuth::where('id', 1)->first(),
            ],
            'ziggy' => fn (): array => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'warning' => fn() => $request->session()->get('warning'),
                'error' => fn() => $request->session()->get('error'),
                'status' => fn() => $request->session()->get('status'),
                'status_class' => fn() => $request->session()->get('status_class'),
            ],
        ];
    }
}

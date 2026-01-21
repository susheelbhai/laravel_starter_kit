<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders = ['google', 'facebook', 'x', 'linkedin'];

    public function __construct()
    {
        Config::set('services.google.redirect', route('admin.social.callback', 'google'));
        Config::set('services.facebook.redirect', route('admin.social.callback', 'facebook'));
        Config::set('services.x.redirect', route('admin.social.callback', 'x'));
        Config::set('services.linkedin-openid.redirect', route('admin.social.callback', 'linkedin'));
    }
    protected function getDriverName($provider)
    {
        $driverMap = [
            'google' => 'google',
            'facebook' => 'facebook',
            'x' => 'x',
            'linkedin' => 'linkedin-openid',
        ];

        return $driverMap[$provider] ?? $provider;
    }

  
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->supportedProviders)) {
            abort(404);
        }

        $driver = $this->getDriverName($provider);
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->supportedProviders)) {
            abort(404);
        }

        try {
            $driver = $this->getDriverName($provider);
            $socialUser = Socialite::driver($driver)->user();

            $admin = Admin::where('email', $socialUser->getEmail())->first();

            if ($admin) {
                // Admin exists, log them in
                Auth::guard('admin')->login($admin);
            } else {
                return redirect()->route('admin.login')->withErrors([$provider => "No admin account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('admin.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('admin.login')->withErrors([$provider => "Unable to login with {$providerName}."]);
        }
    }

}
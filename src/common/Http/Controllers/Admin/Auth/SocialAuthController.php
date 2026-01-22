<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders;

    public function __construct()
    {
        $this->supportedProviders = config('services.supportedSocialProviders.admin');
        foreach ($this->supportedProviders as $provider => $data) {
            $driver = $data['driver'];
            $redirectRoute = route('admin.social.callback', $provider);
            Config::set("services.{$driver}.redirect", $redirectRoute);
        }
    }

    public function redirectToProvider($provider)
    {
        if (!array_key_exists($provider, $this->supportedProviders)) {
            abort(404);
        }

        $driver = $this->supportedProviders[$provider]['driver'];
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if (!array_key_exists($provider, $this->supportedProviders)) {
            abort(404);
        }
        try {
            $driver = $this->supportedProviders[$provider]['driver'];
            $socialUser = Socialite::driver($driver)->user();
            $admin = Admin::where('email', $socialUser->getEmail())->first();

            if ($admin) {
                // Admin exists, log them in
                Auth::guard('admin')->login($admin);
            } else {
                return redirect()->route('admin.login')->with(['error' => "No admin account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('admin.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('admin.login')->with(['error' => "Unable to login with {$providerName}."]);
        }
    }
}

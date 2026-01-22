<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders;

    public function __construct()
    {
        $this->supportedProviders = config('services.supportedSocialProviders.user');
        foreach ($this->supportedProviders as $provider => $data) {
            $driver = $data['driver'];
            $redirectRoute = route('social.callback', $provider);
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
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // User exists, log them in
                Auth::guard('web')->login($user);
            } else {
                return redirect()->route('login')->with(['error' => "No user account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('user.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('login')->with(['error' => "Unable to login with {$providerName}."]);
        }
    }
}

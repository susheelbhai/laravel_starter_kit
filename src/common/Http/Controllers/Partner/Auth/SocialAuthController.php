<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders;

    public function __construct()
    {
        $this->supportedProviders = config('services.supportedSocialProviders.partner');
        foreach ($this->supportedProviders as $provider => $data) {
            $driver = $data['driver'];
            $redirectRoute = route('partner.social.callback', $provider);
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
            $partner = Partner::where('email', $socialUser->getEmail())->first();

            if ($partner) {
                // Partner exists, log them in
                Auth::guard('partner')->login($partner);
            } else {
                return redirect()->route('partner.login')->with(['error' => "No partner account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('partner.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('partner.login')->with(['error' => "Unable to login with {$providerName}."]);
        }
    }
}

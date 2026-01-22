<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders;

    public function __construct()
    {
        $this->supportedProviders = config('services.supportedSocialProviders.seller');
        foreach ($this->supportedProviders as $provider => $data) {
            $driver = $data['driver'];
            $redirectRoute = route('seller.social.callback', $provider);
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
            $seller = Seller::where('email', $socialUser->getEmail())->first();

            if ($seller) {
                // Seller exists, log them in
                Auth::guard('seller')->login($seller);
            } else {
                return redirect()->route('seller.login')->with(['error' => "No seller account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('seller.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('seller.login')->with(['error' => "Unable to login with {$providerName}."]);
        }
    }
}

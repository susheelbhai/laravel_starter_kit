<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders = ['google', 'facebook', 'x', 'linkedin'];

    public function __construct()
    {
        Config::set('services.google.redirect', route('seller.social.callback', 'google'));
        Config::set('services.facebook.redirect', route('seller.social.callback', 'facebook'));
        Config::set('services.x.redirect', route('seller.social.callback', 'x'));
        Config::set('services.linkedin-openid.redirect', route('seller.social.callback', 'linkedin'));
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

    /**
     * Get the user model field name for the provider's unique ID.
     */
    protected function getProviderIdField($provider)
    {
        $fields = [
            'google' => 'google_id',
            'facebook' => 'facebook_id',
            'x' => 'x_id',
            'linkedin' => 'linkedin_id',
        ];

        return $fields[$provider] ?? null;
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

            $seller = Seller::where('email', $socialUser->getEmail())->first();

            if ($seller) {
                // Seller exists, log them in
                Auth::guard('seller')->login($seller);
            } else {
                return redirect()->route('seller.login')->withErrors([$provider => "No seller account associated with this {$provider} account."]);
            }

            return redirect()->intended(route('seller.dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('seller.login')->withErrors([$provider => "Unable to login with {$providerName}."]);
        }
    }

}

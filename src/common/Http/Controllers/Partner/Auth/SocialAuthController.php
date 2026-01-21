<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders = ['google', 'facebook', 'x', 'linkedin'];

    public function __construct()
    {
        Config::set('services.google.redirect', route('partner.social.callback', 'google'));
        Config::set('services.facebook.redirect', route('partner.social.callback', 'facebook'));
        Config::set('services.x.redirect', route('partner.social.callback', 'x'));
        Config::set('services.linkedin-openid.redirect', route('partner.social.callback', 'linkedin'));
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
            return redirect()->route('partner.login')->withErrors([$provider => "Unable to login with {$providerName}."]);
        }
    }

}

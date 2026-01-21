<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    protected $supportedProviders = ['google', 'facebook', 'x', 'linkedin'];

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
        // dd($provider);
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
            // dd($socialUser);
            
            $user = User::where('email', $socialUser->getEmail())->first();
            $idField = $this->getProviderIdField($provider);

            if ($user) {
                // User exists, log them in
                Auth::guard('web')->login($user);
            } else {
                // Create new user
                $userData = [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                    'password' => Hash::make(uniqid()), // Random password since they'll use social login
                    'email_verified_at' => now(),
                ];

                if ($idField) {
                    $userData[$idField] = $socialUser->getId();
                }

                $user = User::create($userData);
                Auth::guard('web')->login($user);
            }

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            $providerName = ucfirst($provider);
            return redirect()->route('login')->with(['error' => "Unable to login with {$providerName}."]);
        }
    }
}

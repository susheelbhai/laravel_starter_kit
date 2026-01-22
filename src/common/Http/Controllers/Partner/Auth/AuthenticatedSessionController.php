<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    
    public function create(Request $request)
    {
        $socialData = collect(config('services.supportedSocialProviders.partner'))->map(function ($item, $key) {
            return [
                $key => [
                    'driver' => $item['driver'],
                    'href' => route('partner.social.login', $key),
                ],
            ];
        })->values();
        return $this->render('partner/auth/login', [
            'submitUrl' => route('partner.login'),
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
            'socialData' => $socialData,
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = Partner::whereEmail($request['email'])
        ->orWhere('phone', $request['email'])
        ->first();
        // dd($user);
        $request->authenticate($user,'partner');

        $request->session()->regenerate();

        return redirect()->intended(route('partner.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('partner')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('partner.login');
    }
}

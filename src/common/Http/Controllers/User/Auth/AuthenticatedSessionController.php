<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
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
        $socialData = collect(config('services.supportedSocialProviders.user'))->map(function ($item, $key) {
            return [
                $key => [
                    'driver' => $item['driver'],
                    'href' => route('social.login', $key),
                ],
            ];
        })->values();
        return $this->render('user/auth/login', [
            'submitUrl' => route('login'),
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
            'socialData' => $socialData,
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::whereEmail($request['email'])
        ->orWhere('phone', $request['email'])
        ->first();
        $request->authenticate($user,'web');
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

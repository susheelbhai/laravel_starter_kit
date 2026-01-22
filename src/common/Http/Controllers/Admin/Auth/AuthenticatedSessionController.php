<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
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
       $socialData = collect(config('services.supportedSocialProviders.admin'))->map(function ($item, $key) {
            return [
                $key => [
                    'driver' => $item['driver'],
                    'href' => route('admin.social.login', $key),
                ],
            ];
        })->values();
        return $this->render('admin/auth/login', [
            'submitUrl' => route('admin.login'),
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
        $user = Admin::whereEmail($request['email'])
        ->orWhere('phone', $request['email'])
        ->first();
        $request->authenticate($user,'admin');

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

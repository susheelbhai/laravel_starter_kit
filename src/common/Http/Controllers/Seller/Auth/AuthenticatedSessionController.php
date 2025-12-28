<?php

namespace App\Http\Controllers\Seller\Auth;

use Inertia\Inertia;
use App\Models\Seller;
use Inertia\Response;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    
    public function create(Request $request): Response
    {
        return $this->render('seller/auth/login', [
            'submitUrl' => route('seller.login'),
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = Seller::whereEmail($request['email'])
        ->orWhere('phone', $request['email'])
        ->first();
        // dd($user);
        $request->authenticate($user,'seller');

        $request->session()->regenerate();

        return redirect()->intended(route('seller.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('seller')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('seller.login');
    }
}

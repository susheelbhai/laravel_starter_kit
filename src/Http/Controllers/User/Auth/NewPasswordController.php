<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('user.auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'user_type_id' => 3, 
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('status', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email,'user_type_id' => 3])->delete();

        return redirect()->route('login')->with('status', 'Your password has been changed!');
    }
}

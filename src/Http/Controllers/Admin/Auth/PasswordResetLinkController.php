<?php

namespace App\Http\Controllers\Admin\Auth;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendPasswordResetLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
        ]);

        $token = Str::random(64);
        $token_url = route('admin.password.reset',$token).'?email='.$request->email;
        $data = Admin::whereEmail($request->email)->first();
        DB::table('password_resets')->updateOrInsert(
            [
                'email' => $request->email,
                'user_type_id' => 1,
            ],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        dispatch(new SendPasswordResetLink($data, $token_url));

        return back()->with('status', 'We have e-mailed your password reset link!');

    }
}

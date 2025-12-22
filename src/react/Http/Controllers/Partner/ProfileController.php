<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use App\Models\Partner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $data = $request->user();
        $status = $request->session()->get('status');
        return Inertia::render('partner/settings/profile', compact('data', 'status'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('partner')->fill($request->validated());

        if ($request->user('partner')->isDirty('email')) {
            $request->user('partner')->email_verified_at = null;
        }

        $partner = Partner::find(Auth::guard('partner')->user()->id);
        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->save();

        if ($request->hasFile('profile_pic')) {
            $partner->clearMediaCollection('profile_pic');
            $partner->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }


        return Redirect::route('partner.profile.edit')->with('success', 'profile-updated');
    }

}

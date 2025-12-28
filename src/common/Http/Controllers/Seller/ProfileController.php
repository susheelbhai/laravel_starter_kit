<?php

namespace App\Http\Controllers\Seller;

use Inertia\Inertia;
use App\Models\Seller;
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
        return $this->render('seller/settings/profile', compact('data', 'status'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('seller')->fill($request->validated());

        if ($request->user('seller')->isDirty('email')) {
            $request->user('seller')->email_verified_at = null;
        }

        $seller = Seller::find(Auth::guard('seller')->user()->id);
        $seller->name = $request->name;
        $seller->phone = $request->phone;
        $seller->email = $request->email;
        $seller->save();

        if ($request->hasFile('profile_pic')) {
            $seller->clearMediaCollection('profile_pic');
            $seller->addMediaFromRequest('profile_pic')
                ->toMediaCollection('profile_pic');
        }


        return Redirect::route('seller.profile.edit')->with('success', 'profile-updated');
    }

}

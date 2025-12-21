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
        return Inertia::render('seller/settings/profile', compact('data', 'status'));
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

        $image_name = Auth::guard('seller')->user()->profile_pic;
        if ($request->hasFile('profile_pic')) {
            $image_name = 'images/profile_pic/seller/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/seller/'), $image_name);
            if (Auth::guard('seller')->user()->profile_pic != 'dummy.png') {
                File::delete(public_path('storage/images/profile_pic/seller/' . Auth::guard('seller')->user()->profile_pic));
            }
        }

        Seller::where('id', Auth::guard('seller')->user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_pic' => $image_name,
        ]);


        return Redirect::route('seller.profile.edit')->with('success', 'profile-updated');
    }

}

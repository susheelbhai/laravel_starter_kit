<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Admin;
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
        return Inertia::render('admin/settings/profile', compact('data', 'status'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('admin')->fill($request->validated());

        if ($request->user('admin')->isDirty('email')) {
            $request->user('admin')->email_verified_at = null;
        }

        $image_name = Auth::guard('admin')->user()->profile_pic;
        if ($request->hasFile('profile_pic')) {
            $image_name = 'images/profile_pic/admin/' . uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/images/profile_pic/admin/'), $image_name);
            if (Auth::guard('admin')->user()->profile_pic != 'dummy.png') {
                File::delete(public_path('storage/images/profile_pic/admin/' . Auth::guard('admin')->user()->profile_pic));
            }
        }

        Admin::where('id', Auth::guard('admin')->user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_pic' => $image_name,
        ]);


        return Redirect::route('admin.profile.edit')->with('success', 'profile-updated');
    }

}

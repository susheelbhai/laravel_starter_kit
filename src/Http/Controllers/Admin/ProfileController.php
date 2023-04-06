<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\AdminProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => Auth::guard('admin')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('admin')->fill($request->validated());

        if ($request->user('admin')->isDirty('email')) {
            $request->user('admin')->email_verified_at = null;
        }

        $img_path = public_path('/storage/images/admin/profile/');
        $image_name = Auth::guard('admin')->user()->profile_pic;
        if ($request->hasFile('profile_pic')) {
            $image_name = uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $profile_pic = Image::make($request->file('profile_pic'));
            $profile_pic->resize(240,240);
            $profile_pic->save($img_path . $image_name);
            if (Auth::guard('admin')->user()->profile_pic != 'dummy.png') {
                File::delete(public_path('storage/images/admin/profile/' . Auth::guard('admin')->user()->profile_pic));
            }
        }

        Admin::where('admin_id', Auth::guard('admin')->user()->admin_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_pic' => $image_name,
        ]);


        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }
}

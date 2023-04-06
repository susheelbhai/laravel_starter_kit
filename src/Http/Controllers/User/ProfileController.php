<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\UserProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => Auth::guard('user')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('user')->fill($request->validated());

        if ($request->user('user')->isDirty('email')) {
            $request->user('user')->email_verified_at = null;
        }

        $img_path = public_path('/storage/images/user/profile/');
        $image_name = Auth::guard('user')->user()->profile_pic;
        if ($request->hasFile('profile_pic')) {
            $image_name = uniqid() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $profile_pic = Image::make($request->file('profile_pic'));
            $profile_pic->resize(240, 240);
            $profile_pic->save($img_path . $image_name);
            if (Auth::guard('user')->user()->profile_pic != 'dummy.png') {
                File::delete(public_path('storage/images/user/profile/' . Auth::guard('user')->user()->profile_pic));
            }
        }
        User::where('user_id', Auth::guard('user')->user()->user_id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'profile_pic' => $image_name,
            ]);


        return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
    }
}

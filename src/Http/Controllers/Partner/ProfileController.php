<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\PartnerProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('partner.profile.edit', [
            'user' => Auth::guard('partner')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(PartnerProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('partner')->fill($request->validated());
        
        if ($request->user('partner')->isDirty('email')) {
            $request->user('partner')->email_verified_at = null;
        }
        // return $request->profile_pic;

        // $request->user('partner')->save();

        if($request->profile_pic==''){
            $image_name=Auth::guard('partner')->user()->profile_pic;
          }
          else{
            $image_name=uniqid().'.'.$request->file('profile_pic')->getClientOriginalExtension();
            $request->profile_pic->move(public_path('/storage/partner/images/profile'),$image_name);
            File::delete(public_path('storage/partner/images/profile/'.Auth::guard('partner')->user()->profile_pic));
          }
          Partner::where('partner_id', Auth::guard('partner')->user()->partner_id)->
          update([
              'name' => $request->name,
              'phone' => $request->phone,
              'email' => $request->email,
              'profile_pic' => $image_name,
            ]);


        return Redirect::route('partner.profile.edit')->with('status', 'profile-updated');
    }
    
}

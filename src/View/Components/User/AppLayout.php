<?php

namespace App\View\Components\User;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $settings;
    public $user;
    public $profile_pic;
    public function __construct()
    {
        $this->settings = Setting::where('id', 1)->first();
        $this->user = Auth::guard('user')->user();
        if (Auth::guard('admin')->check()) {
            $this->profile_pic = url('storage/images/admin/profile/').'/'. Auth::guard('admin')->user()->profile_pic;
        }
        else{
            $this->profile_pic = 'dummy.png';
        }
        
    }


    public function render(): View
    {
        return view('user.layouts.app');
    }
}

<?php

namespace App\View\Components\Partner;

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
        $this->profile_pic = url('storage/images/partner/profile/').'/'. Auth::guard('partner')->user()->profile_pic;
        $this->user = Auth::guard('partner')->user();
    }


    public function render(): View
    {
        return view('partner.layouts.app');
    }
}

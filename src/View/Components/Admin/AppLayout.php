<?php

namespace App\View\Components\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */

    public $settings;
    public $user;
    public $profile_pic;
    public function __construct()
    {
        $this->settings = Config::get('settings');
        $this->profile_pic = url('storage/images/admin/profile/').'/'. Auth::guard('admin')->user()->profile_pic;
        $this->user = Auth::guard('admin')->user();
    }


    public function render(): View
    {
        return view('admin.layouts.app');
    }
}

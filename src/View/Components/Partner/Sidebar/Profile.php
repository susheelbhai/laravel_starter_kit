<?php

namespace App\View\Components\Partner\Sidebar;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Profile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $user;
    public $src;
    public function __construct()
    {
        $this->settings = Setting::where('id', 1)->first();
        $this->user = Auth::guard('partner')->user();
        $this->src = url('storage/partner/images/profile/').'/'.$this->user->profile_pic;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->partner_theme.'.sidebar.profile');
    }
}

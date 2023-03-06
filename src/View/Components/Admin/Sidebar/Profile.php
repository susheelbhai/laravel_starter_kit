<?php

namespace App\View\Components\Admin\Sidebar;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
        $this->settings = Config::get('settings');
        $this->user = Auth::guard('admin')->user();
        $this->src = url('storage/images/admin/profile/').'/'.$this->user->profile_pic;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->admin_theme.'.sidebar.profile');
    }
}

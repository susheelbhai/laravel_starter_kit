<?php

namespace App\View\Components\Admin;

use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class GuestLayout extends Component
{
    public $settings;
    public function __construct()
    {
        $this->settings = Config::get('settings');
    }


    public function render(): View
    {
        return view('components.'.$this->settings->admin_theme.'.layouts.guest');
    }
}

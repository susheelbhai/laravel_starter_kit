<?php

namespace App\View\Components\User;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public $settings;
    public function __construct()
    {
        $this->settings = Setting::where('id', 1)->first();
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.'.$this->settings->user_theme.'.layouts.guest');
    }
}

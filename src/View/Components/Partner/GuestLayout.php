<?php

namespace App\View\Components\Partner;

use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    public $settings;
    public function __construct()
    {
        $this->settings = Setting::where('id', 1)->first();
    }


    public function render(): View
    {
        return view('components.'.$this->settings->partner_theme.'.layouts.guest');
    }
}

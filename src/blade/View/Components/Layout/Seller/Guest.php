<?php

namespace App\View\Components\Layout\Seller;

use Closure;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class Guest extends Component
{
    public function __construct()
    {
        $setting = Setting::find(1);
        Config::set('app.name', $setting['app_name']);
        Config::set('app.dark_logo', $setting['dark_logo']);
        Config::set('app.light_logo', $setting['light_logo']);
        Config::set('app.dark_logo_small', $setting['favicon']);
        Config::set('app.light_logo_small', $setting['favicon']);
        Config::set('app.favicon', $setting['favicon']);
    }
    public function render(): View|Closure|string
    {
        return view('components.layout.seller.guest');
    }
}

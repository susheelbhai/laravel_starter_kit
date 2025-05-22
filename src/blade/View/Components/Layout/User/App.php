<?php

namespace App\View\Components\Layout\User;

use App\Models\Setting;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class App extends Component
{
    public $setting;
    public function __construct()
    {
        $user = Auth::guard('web')->user();
        $setting = Setting::find(1);
        $theme = 'user1';
        $user = [
            'login' => $user,
            'theme' => $theme,
        ];
        Session::put('user',$user);
        Config::set('app.name', $setting['app_name']);
        Config::set('app.phone', $setting['phone']);
        Config::set('app.email', $setting['email']);
        Config::set('app.address', $setting['address']);
        Config::set('app.dark_logo', $setting['dark_logo']);
        Config::set('app.light_logo', $setting['light_logo']);
        Config::set('app.favicon', $setting['favicon']);
        Config::set('app.facebook', $setting['facebook']);
        Config::set('app.twitter', $setting['twitter']);
        Config::set('app.linkedin', $setting['linkedin']);
        Config::set('app.instagram', $setting['instagram']);
        $this->setting = $setting;
    }

    public function render(): View|Closure|string
    {
        return view('components.layout.user.app');
    }
}

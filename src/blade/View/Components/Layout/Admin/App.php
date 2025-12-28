<?php

namespace App\View\Components\Layout\Admin;

use Closure;
use App\Models\Theme;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Facades\Session;

class App extends Component
{
    /**
     * The application settings.
     *
     * @var \App\Models\Setting
     */
    public $setting;

    public function __construct()
    {
        $user = Auth::guard('admin')->user();
        $this->setting = Setting::find(1);
        ViewFacade::share('setting', $this->setting);
        $theme = 'theme1';
        $user = [
            'login' => $user,
            'theme' => $theme,
        ];
        Session::put('user',$user);
    }

    public function render(): View|Closure|string
    {
        return view('components.layout.admin.app');
    }
}

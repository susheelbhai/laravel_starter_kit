<?php

namespace App\View\Components\Layout\User;

use Closure;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class Guest extends Component
{
    public $setting;
    public function __construct()
    {
        $this->setting = Setting::find(1);
        ViewFacade::share('setting', $this->setting);
    }
    public function render(): View|Closure|string
    {
        return view('components.layout.user.guest');
    }
}

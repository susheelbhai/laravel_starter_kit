<?php

namespace App\View\Components\Layout;

use Closure;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class App extends Component
{
    public $setting;
    public function __construct()
    {
        // dd(Session::get('user')['theme']);
        $setting = Setting::find(1);
        $this->setting = $setting;
    }

    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.app');
    }
}

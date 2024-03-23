<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class App extends Component
{
    public function __construct()
    {
        
    }

    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.app');
    }
}

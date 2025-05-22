<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Li21 extends Component
{
    public $name;
    public $href;
    public function __construct($name, $href)
    {
        $this->name = $name;
        $this->href = $href;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li21');
    }
}

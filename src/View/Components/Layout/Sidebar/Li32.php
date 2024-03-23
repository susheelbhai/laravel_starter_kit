<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Li32 extends Component
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li32');
    }
}

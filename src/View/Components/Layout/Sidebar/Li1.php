<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Li1 extends Component
{
    public $name;
    public $href;
    public $icon;
    public function __construct($name, $href, $icon)
    {
        $this->name = $name;
        $this->href = $href;
        $this->icon = $icon;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li1');
    }
}

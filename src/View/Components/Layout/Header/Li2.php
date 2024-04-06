<?php

namespace App\View\Components\Layout\Header;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Li2 extends Component
{
    public $name;
    public $icon;
    public $style;
    public function __construct($name, $icon = '', $style='1')
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->style = $style;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.header.li2');
    }
}

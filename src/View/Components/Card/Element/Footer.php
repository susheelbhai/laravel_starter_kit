<?php

namespace App\View\Components\Card\Element;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Footer extends Component
{
    public $action;
    public $target;
    public $div;
    public function __construct( $action="#", $target="_self", $div=2)
    {
        $this->div = $div;
        $this->action = $action;
        $this->target = $target;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.card.element.footer');
    }
    
}

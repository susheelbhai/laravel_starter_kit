<?php

namespace App\View\Components\Card\Type;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Image extends Component
{
    public $action;
    public $target;
    public $div;
    public $src;
    public function __construct( $action="#", $target="_self", $src="_self", $div=2)
    {
        $this->div = $div;
        $this->src = $src;
        $this->action = $action;
        $this->target = $target;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.card.type.image');
    }
}

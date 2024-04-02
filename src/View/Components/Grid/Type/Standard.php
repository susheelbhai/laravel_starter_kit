<?php

namespace App\View\Components\Grid\Type;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Standard extends Component
{
    public $type;
    public $action;
    public $target;
    public $div;
    public function __construct($type="row", $action="#", $target="_self", $div=1)
    {
        $this->type = $type;
        $this->div = $div;
        $this->action = $action;
        $this->target = $target;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.grid.type.standard');
    }
}

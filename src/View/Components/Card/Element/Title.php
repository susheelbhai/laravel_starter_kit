<?php

namespace App\View\Components\Card\Element;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Title extends Component
{
    public $title;
    public $action;
    public $target;
    public $div;
    public function __construct($title="Title", $action="#", $target="_self", $div=2)
    {
        $this->title = $title;
        $this->div = $div;
        $this->action = $action;
        $this->target = $target;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.card.element.title');
    }
}

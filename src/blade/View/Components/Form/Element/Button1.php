<?php

namespace App\View\Components\Form\Element;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Button1 extends Component
{
    public $title;
    public $type;
    public $div;
    public function __construct($title, $type, $div=2)
    {
        $this->title = $title;
        $this->type = $type;
        $this->div = $div;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.form.element.button1');
    }

}

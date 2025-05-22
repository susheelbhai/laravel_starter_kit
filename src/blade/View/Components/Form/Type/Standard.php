<?php

namespace App\View\Components\Form\Type;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Standard extends Component
{
    public $title;
    public $action;
    public $method;
    public $submitName;
    public function __construct($title, $action="#", $method="post", $submitName="Submit")
    {
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
        $this->submitName = $submitName;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.form.type.standard');
    }
}

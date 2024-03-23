<?php

namespace App\View\Components\Form\Type;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Login extends Component
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
        return view('theme1.form.type.login');
    }
}

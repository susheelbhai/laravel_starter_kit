<?php

namespace App\View\Components\Form\Element;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Input1 extends Component
{
    public $name;
    public $label;
    public $type;
    public $options;
    public $value;
    public $placeholder;
    public $required;
    public $div;
    public function __construct($name, $label="#", $type="text", $options=[], $value="", $placeholder="", $required="", $div=2)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->options = $options;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->div = $div;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.form.element.input1');
    }
}

<?php

namespace App\View\Components\Form\Element;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputLogin extends Component
{
    public $name;
    public $label;
    public $type;
    public $options;
    public $value;
    public $placeholder;
    public $required;
    public $div;
    public function __construct($name, $label="#", $type="text", $options=[], $value="", $placeholder="", $required="", $div=1)
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
        return view('theme1.form.element.input-login');
    }
}

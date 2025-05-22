<?php

namespace App\View\Components\Form\Element;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class InputImg extends Component
{
    public $name;
    public $label;
    public $value;
    public $type;
    public $div;
    public $ratio;
    public $required;
    public function __construct($name='', $label='', $value = '', $type= '',$required="", $ratio=56.25, $div=2)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
        $this->div = $div;
        $this->ratio = $ratio;
        $this->required = $required;
    }

    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.form.element.input-img');
    }
}

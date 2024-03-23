<?php

namespace App\View\Components\Form\Element;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public $title;
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.form.element.form-group');
    }
}

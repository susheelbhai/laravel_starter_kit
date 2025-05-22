<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class ValidationError extends Component
{
    public $value;
    public function __construct($value)
    {
        $this->value = $value;
    }
    public function render(): View|Closure|string
    {
        return view('theme1.form.validation-error');
    }
}

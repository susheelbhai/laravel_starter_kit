<?php

namespace App\View\Components\Table\Element;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Th extends Component
{
    public $data2;
    public $colspan;
    public function __construct($data, $colspan=1)
    {
        $this->data2 = $data;
        $this->colspan = $colspan;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.table.element.th');
    }
}

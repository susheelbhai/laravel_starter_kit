<?php

namespace App\View\Components\Table\Type;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Paginate extends Component
{
    public $title;
    public $addUrl;
    public $inputName;
    public $data2;
    public function __construct($title, $addUrl="#", $inputName="input", $data="")
    {
        $this->title = $title;
        $this->addUrl = $addUrl;
        $this->inputName = $inputName;
        $this->data2 = $data;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.table.type.paginate');
    }
}

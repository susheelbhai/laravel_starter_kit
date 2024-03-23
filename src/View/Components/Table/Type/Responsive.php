<?php

namespace App\View\Components\Table\Type;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Responsive extends Component
{
    public $title;
    public $addUrl;
    public function __construct($title, $addUrl="#")
    {
        $this->title = $title;
        $this->addUrl = $addUrl;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.table.type.responsive');
    }
}

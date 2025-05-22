<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Badge extends Component
{
    public $title;
    public $type;
    public $size;
    public function __construct($title, $type = 'success', $size='lg')
    {
        $this->title = $title;
        $this->type = $type;
        $this->size = $size;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.ui.badge');
    }
}

<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public $title;
    public $type;
    public $size;
    public function __construct($title, $type, $size='lg')
    {
        $this->title = $title;
        $this->type = $type;
        $this->size = $size;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.ui.badge');
    }
}

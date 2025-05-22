<?php

namespace App\View\Components\Resources\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IndexTh extends Component
{
    public $data2;
    public function __construct($data=[])
    {
        $this->data2 = $data;
    }

    public function render(): View|Closure|string
    {
        return view('components.resources.product.index-th');
    }
}

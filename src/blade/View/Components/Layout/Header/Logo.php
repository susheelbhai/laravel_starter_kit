<?php

namespace App\View\Components\Layout\Header;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class Logo extends Component
{
    public $href;
    public $darkLogo;
    public $darkLogoSmall;
    public $lightLogo;
    public $lightLogoSmall;
    
    public function __construct($href="#", $darkLogo="#a", $darkLogoSmall="#", $lightLogo="#", $lightLogoSmall="#")
    {
        $this->href = $href;
        $this->darkLogo = $darkLogo;
        $this->darkLogoSmall = $darkLogoSmall;
        $this->lightLogo = $lightLogo;
        $this->lightLogoSmall = $lightLogoSmall;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.header.logo');
    }
}

<?php

namespace App\View\Components\User\Layout;

use App\Models\Setting;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $menu;
    public function __construct($menu)
    {
        $this->settings = Setting::where('id', 1)->first();
        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
            $header = 'header';
            if (url()->current() == route('home')) {
                $header = 'header';
            }
        return view('components.'.$this->settings->user_theme.'.layouts.'.$header);
    }
}

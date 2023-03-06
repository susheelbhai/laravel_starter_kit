<?php

namespace App\View\Components\Partner\Sidebar;

use App\Models\Setting;
use Illuminate\View\Component;

class Li2 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public function __construct()
    {
        $this->settings = Setting::where('id', 1)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->partner_theme.'.sidebar.li2');
    }
}

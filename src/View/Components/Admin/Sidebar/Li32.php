<?php

namespace App\View\Components\Admin\Sidebar;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class Li32 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public function __construct()
    {
        $this->settings = Config::get('settings');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->admin_theme.'.sidebar.li32');
    }
}

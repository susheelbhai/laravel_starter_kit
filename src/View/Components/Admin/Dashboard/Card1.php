<?php

namespace App\View\Components\Admin\Dashboard;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class Card1 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $heading;
    public $icon;
    public $data1;
    public $data2;
    public $data3;
    public function __construct($heading='', $icon='', $data1='', $data2 = '', $data3= '')
    {
        $this->settings = Config::get('settings');
        $this->heading = $heading;
        $this->icon = $icon;
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->data3 = $data3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->admin_theme.'.dashboard.card1');
    }
}

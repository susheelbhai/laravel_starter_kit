<?php

namespace App\View\Components\User\Section;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class BannerBreadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $breadcrumb_data;
    public $lbl;
    public $value;
    public $data3;
    public function __construct($data='', $lbl='', $value = '', $data3= '')
    {
        $this->settings = Config::get('settings');
        $this->breadcrumb_data = $data;
        $this->lbl = $lbl;
        $this->value = $value;
        $this->data3 = $data3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->user_theme.'.section.banner-breadcrumb');
    }
}

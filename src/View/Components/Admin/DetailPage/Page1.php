<?php

namespace App\View\Components\Admin\DetailPage;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class Page1 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $heading;
    public $details;
    public $editUrl;
    public function __construct($heading='', $details='', $editUrl='')
    {
        $this->settings = Config::get('settings');
        $this->heading = $heading;
        $this->details = $details;
        $this->editUrl = $editUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->admin_theme.'.detail-page.page1');
    }
}

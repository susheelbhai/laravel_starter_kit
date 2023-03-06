<?php

namespace App\View\Components\Partner\DetailPage;

use App\Models\Setting;
use Illuminate\View\Component;

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
        $this->settings = Setting::where('id', 1)->first();
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
        return view('components.'.$this->settings->partner_theme.'.detail-page.page1');
    }
}

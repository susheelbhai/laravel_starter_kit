<?php

namespace App\View\Components\Partner\Form;

use App\Models\Setting;
use Illuminate\View\Component;

class Form1 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $name;
    public $lbl;
    public $method;
    public $action;
    public $submit;
    public function __construct($name='', $lbl='', $method='', $action = '', $submit= 'Submit')
    {
        $this->settings = Setting::where('id', 1)->first();
        $this->name = $name;
        $this->lbl = $lbl;
        $this->method = $method;
        $this->action = $action;
        $this->submit = $submit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->partner_theme.'.form.form1');
    }
}

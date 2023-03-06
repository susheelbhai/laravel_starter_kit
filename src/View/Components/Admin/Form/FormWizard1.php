<?php

namespace App\View\Components\Admin\Form;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class FormWizard1 extends Component
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
        $this->settings = Config::get('settings');
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
        return view('components.'.$this->settings->admin_theme.'.form.form-wizard1');
    }
}

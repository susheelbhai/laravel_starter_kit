<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class LoginForm extends Component
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
    public function __construct($name='', $lbl='', $method='', $action = '')
    {
        $this->settings = Config::get('settings');
        $this->name = $name;
        $this->lbl = $lbl;
        $this->method = $method;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->admin_theme.'.form.login-form');
    }
}

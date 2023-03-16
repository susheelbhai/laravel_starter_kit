<?php

namespace App\View\Components\User\Form;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class LoginInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $name;
    public $lbl;
    public $type;
    public $value;
    public function __construct($name='', $lbl='', $type='', $value = '')
    {
        $this->settings = Config::get('settings');
        $this->name = $name;
        $this->type = $type;
        $this->lbl = $lbl;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->user_theme.'.form.login-input');
    }
}

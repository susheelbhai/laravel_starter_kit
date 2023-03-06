<?php

namespace App\View\Components\Admin\Form;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class InputImg1 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $settings;
    public $name;
    public $lbl;
    public $value;
    public $data3;
    public function __construct($name='', $lbl='', $value = '', $data3= '')
    {
        $this->settings = Config::get('settings');
        $this->name = $name;
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
        return view('components.'.$this->settings->admin_theme.'.form.input-img1');
    }
}

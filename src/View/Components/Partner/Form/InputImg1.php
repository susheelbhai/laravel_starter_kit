<?php

namespace App\View\Components\Partner\Form;

use App\Models\Setting;
use Illuminate\View\Component;

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
        $this->settings = Setting::where('id', 1)->first();
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
        return view('components.'.$this->settings->partner_theme.'.form.input-img1');
    }
}

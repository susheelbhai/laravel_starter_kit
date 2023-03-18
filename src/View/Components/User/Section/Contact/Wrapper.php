<?php

namespace App\View\Components\User\Section\Contact;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Config;

class Wrapper extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
     public $settings;
     public function __construct()
     {
         $this->settings = Config::get('settings');
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.'.$this->settings->user_theme.'.section.contact.wrapper');
    }
}

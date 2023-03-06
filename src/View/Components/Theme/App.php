<?php

namespace App\View\Components\Theme;

use Illuminate\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public $theme;
    public $user;
    public $profile_pic;
    public $settings;
    public $variables;
    public function __construct($theme, $user, $profilepic, $settings, $variables)
    {
        $this->theme = $theme;
        $this->profile_pic = $profilepic;
        $this->user = $user;
        $this->settings = $settings;
        $this->variables = $variables;
    }


    public function render(): View
    {
        return view('components.'.$this->theme.'.layouts.app');
    }
}

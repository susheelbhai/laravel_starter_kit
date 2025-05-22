<?php

namespace App\View\Components\Layout\Header;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class ProfileBox extends Component
{
    public $name;
    public $designation;
    public $profile_pic;
    public function __construct($name, $designation, $profilePic)
    {
        $this->name = $name;
        $this->designation = $designation;
        $this->profile_pic = $profilePic;
    }
    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.header.profile-box');
    }
}

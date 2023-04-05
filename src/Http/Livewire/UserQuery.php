<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserQuery extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        $data = \App\Models\UserQuery::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.user-query', compact('data'));
    }
}

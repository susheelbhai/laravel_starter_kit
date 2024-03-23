<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UserQuery extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\UserQuery::orderBy('id', 'DESC')->paginate(12);
        return view('livewire.user-query', compact('data'));
    }
}

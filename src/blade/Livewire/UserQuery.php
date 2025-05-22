<?php

namespace App\Livewire;

use App\Models\UserQuery as ModelsUserQuery;
use Livewire\Component;
use Livewire\WithPagination;

class UserQuery extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $input;
    public function updatedInput($input)
    {
        $this->input = $input;
    }
    public function render()
    {
        $data = ModelsUserQuery::where(function ($query) {
                $this->query($query);
            })
            ->latest()
            ->paginate(12);
        return view('livewire.user-query', compact('data'));
    }

    public function query($query)
    {
        
        if ($this->input != '') {
            // dd($query);
            $query
            ->where('phone', 'like', '%' . $this->input . '%')
            ->orWhere('name', 'like', '%' . $this->input . '%')
            ->orWhere('email', 'like', '%' . $this->input . '%')
            ->orWhere('subject', 'like', '%' . $this->input . '%');           
        } 
    }
    
}

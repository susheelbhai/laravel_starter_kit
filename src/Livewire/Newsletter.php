<?php

namespace App\Livewire;

use App\Models\Newsletter as ModelsNewsletter;
use Livewire\Component;
use Livewire\WithPagination;

class Newsletter extends Component
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
        $data = ModelsNewsletter::where(function ($query) {
                $this->query($query);
            })
            ->latest()
            ->paginate(12);
        return view('livewire.newsletter', compact('data'));
    }

    public function query($query)
    {
        if ($this->input != '') {
            $query
            ->where('email', 'like', '%' . $this->input . '%')
            ->orWhere('created_at', 'like', '%' . $this->input . '%');         
        } 
    }

    
}

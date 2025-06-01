<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'clients';
    
    public function getLogoAttribute($value): string
    {
        return "/storage/$value";
    }
}

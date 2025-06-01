<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider1 extends Model
{
    use HasFactory;
    protected $table = 'slider1';

    
    public function getImage1Attribute($value): string
    {
        return "/storage/$value";
    }

    
    public function getImage2Attribute($value): string
    {
        return "/storage/$value";
    }
}

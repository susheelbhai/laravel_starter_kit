<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    
    public function getDisplayImgAttribute($value): string
    {
        return "/storage/$value";
    }
    
    public function getAdImgAttribute($value): string
    {
        return "/storage/$value";
    }
}

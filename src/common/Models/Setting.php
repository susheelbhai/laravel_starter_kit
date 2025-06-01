<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getFaviconAttribute($value): string
    {
        return "/storage/$value";
    }

    public function getDarkLogoAttribute($value): string
    {
        return "/storage/$value";
    }

    public function getLightLogoAttribute($value): string
    {
        return "/storage/$value";
    }
}

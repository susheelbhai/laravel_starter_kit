<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAbout extends Model
{
    use HasFactory;
    protected $table = 'page_about';

    public function getBannerAttribute($value): string
    {
        return "/storage/$value";
    }

    public function getFounderImageAttribute($value): string
    {
        return "/storage/$value";
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagePrivacy extends Model
{
    use HasFactory;
    protected $table = 'page_privacy';

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('jS F Y');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTnc extends Model
{
    use HasFactory;
    protected $table = 'page_tnc';

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('jS F Y');
    }
}

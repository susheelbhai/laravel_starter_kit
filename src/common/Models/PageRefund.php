<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PageRefund extends Model
{
    use HasFactory;

    protected $table = 'page_refund';

    // Override the default accessor for updated_at
    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('jS F Y');
    }
}

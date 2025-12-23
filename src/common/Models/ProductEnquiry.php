<?php

namespace App\Models;

use App\Traits\HasFormattedDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductEnquiry extends Model
{
    /** @use HasFactory<\Database\Factories\ProductEnquiryFactory> */
    use HasFactory, HasFormattedDates, Notifiable;

    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Route notifications for mail channel.
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}

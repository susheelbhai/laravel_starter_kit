<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;
    public function getBannerAttribute($value): string
    {
        return "/storage/$value";
    }
    public function getIconAttribute($value): string
    {
        return "/storage/$value";
    }
}

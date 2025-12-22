<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Product extends BaseExternalMediaModel
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}

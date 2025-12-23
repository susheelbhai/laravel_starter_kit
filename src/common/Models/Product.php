<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Product extends BaseExternalMediaModel
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $appends = ['images', 'display_img'];

    protected $casts = [
        'features' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    /**
     * Get the display image URL.
     */
    protected function displayImg(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFirstMediaUrl('images') ?: asset('images/placeholder.jpg'),
        );
    }

    /**
     * Get the product category.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Get the product images.
     */
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getMedia('images')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                    'thumbnail' => $media->getUrl('thumb'),
                    'name' => $media->name,
                    'file_name' => $media->file_name,
                    'size' => $media->size,
                    'mime_type' => $media->mime_type,
                ];
            }),
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends BaseExternalMediaModel
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->useDisk('external_media')
            ->singleFile();
        
        $this->addMediaCollection('banner')
            ->useDisk('external_media')
            ->singleFile();
    }
    
    public function getBannerAttribute(): string
    {
        $media = $this->getFirstMedia('banner');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['banner'] ?? '';
    }
    
    public function getIconAttribute(): string
    {
        $media = $this->getFirstMedia('icon');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['icon'] ?? '';
    }
}

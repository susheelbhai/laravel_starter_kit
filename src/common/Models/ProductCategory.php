<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

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
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getBannerConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('banner');
        if (!$media) {
            return [];
        }
        $urls = [];
        foreach ($media->getGeneratedConversions() as $conversionName => $isGenerated) {
            if ($isGenerated) {
                $urls[$conversionName] = $media->getUrl($conversionName);
            }
        }
        return $urls;
    }
    
    public function getIconAttribute(): string
    {
        $media = $this->getFirstMedia('icon');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getIconConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('icon');
        if (!$media) {
            return [];
        }
        $urls = [];
        foreach ($media->getGeneratedConversions() as $conversionName => $isGenerated) {
            if ($isGenerated) {
                $urls[$conversionName] = $media->getUrl($conversionName);
            }
        }
        return $urls;
    }
}

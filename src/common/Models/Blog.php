<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Blog extends BaseExternalMediaModel
{
    use HasFactory;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('display_image')
            ->useDisk('external_media')
            ->singleFile();
        
        $this->addMediaCollection('ad_image')
            ->useDisk('external_media')
            ->singleFile();
    }

    public function getDisplayImgAttribute(): string
    {
        $media = $this->getFirstMedia('display_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getDisplayImgConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('display_image');
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
    
    public function getAdImgAttribute(): string
    {
        $media = $this->getFirstMedia('ad_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getAdImgConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('ad_image');
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

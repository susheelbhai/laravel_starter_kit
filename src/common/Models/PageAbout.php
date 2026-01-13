<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class PageAbout extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'page_about';
    protected $appends = ['banner', 'founder_image', 'banner_converted', 'founder_image_converted'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner')
            ->singleFile();
        
        $this->addMediaCollection('founder_image')
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

    public function getFounderImageAttribute(): string
    {
        $media = $this->getFirstMedia('founder_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getFounderImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('founder_image');
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

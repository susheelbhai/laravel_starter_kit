<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class PageHome extends BaseInternalMediaModel
{
    use HasFactory;
    protected $table = 'page_home';
    protected $appends = [
        'banner_image', 'banner_image_converted',
        'about_image', 'about_image_converted',
        'why_us_image', 'why_us_image_converted'
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner_image')
            ->singleFile();
        
        $this->addMediaCollection('about_image')
            ->singleFile();
        
        $this->addMediaCollection('why_us_image')
            ->singleFile();
    }
    public function getBannerImageAttribute(): string
    {
        $media = $this->getFirstMedia('banner_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getBannerImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('banner_image');
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
    public function getAboutImageAttribute(): string
    {
        $media = $this->getFirstMedia('about_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getAboutImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('about_image');
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

    public function getWhyUsImageAttribute(): string
    {
        $media = $this->getFirstMedia('why_us_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getWhyUsImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('why_us_image');
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

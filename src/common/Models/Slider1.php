<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Slider1 extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'slider1';
    protected $appends = ['image1', 'image1_converted', 'image2', 'image2_converted'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image1')
            ->useDisk('external_media')
            ->singleFile();
        
        $this->addMediaCollection('image2')
            ->useDisk('external_media')
            ->singleFile();
    }

    public function getImage1Attribute(): string
    {
        $media = $this->getFirstMedia('image1');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getImage1ConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('image1');
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

    public function getImage2Attribute(): string
    {
        $media = $this->getFirstMedia('image2');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getImage2ConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('image2');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class Setting extends BaseInternalMediaModel
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['favicon', 'favicon_converted', 'dark_logo', 'dark_logo_converted', 'light_logo', 'light_logo_converted'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('favicon')
            ->singleFile();
        
        $this->addMediaCollection('dark_logo')
            ->singleFile();
        
        $this->addMediaCollection('light_logo')
            ->singleFile();
    }

    public function getFaviconAttribute(): string
    {
        $media = $this->getFirstMedia('favicon');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getFaviconConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('favicon');
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

    public function getDarkLogoAttribute(): string
    {
        $media = $this->getFirstMedia('dark_logo');
        return $media ? $media->getUrl('small') : '/dummy.png';
    }

    public function getDarkLogoConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('dark_logo');
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

    public function getLightLogoAttribute(): string
    {
        $media = $this->getFirstMedia('light_logo');
        return $media ? $media->getUrl('small') : '/dummy.png';
    }

    public function getLightLogoConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('light_logo');
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

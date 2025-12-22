<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class PageHome extends BaseInternalMediaModel
{
    use HasFactory;
    protected $table = 'page_home';
    protected $appends = [
        'banner_image',
        'about_image',
        'why_us_image'
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
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['banner_image'] ?? '';
    }
    public function getAboutImageAttribute(): string
    {
        $media = $this->getFirstMedia('about_image');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['about_image'] ?? '';
    }

    public function getWhyUsImageAttribute(): string
    {
        $media = $this->getFirstMedia('why_us_image');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['why_us_image'] ?? '';
    }
}

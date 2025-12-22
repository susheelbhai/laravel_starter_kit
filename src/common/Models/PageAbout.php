<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class PageAbout extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'page_about';

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
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['banner'] ?? '';
    }

    public function getFounderImageAttribute(): string
    {
        $media = $this->getFirstMedia('founder_image');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['founder_image'] ?? '';
    }
}

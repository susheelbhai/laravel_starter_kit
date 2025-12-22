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
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['display_img'] ?? '';
    }
    
    public function getAdImgAttribute(): string
    {
        $media = $this->getFirstMedia('ad_image');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['ad_img'] ?? '';
    }
}

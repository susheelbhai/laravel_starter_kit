<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Slider1 extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'slider1';

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
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['image1'] ?? '';
    }

    public function getImage2Attribute(): string
    {
        $media = $this->getFirstMedia('image2');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['image2'] ?? '';
    }
}

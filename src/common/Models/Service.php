<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Service extends BaseExternalMediaModel
{
    use HasFactory;
    protected $appends = ['display_img', 'display_img_converted'];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('display_image')
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
    
}

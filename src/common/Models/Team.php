<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class Team extends BaseInternalMediaModel
{
    use HasFactory;
    protected $table = 'team';
    protected $appends = ['image', 'image_converted'];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }
    
    
    public function getImageAttribute(): string
    {
        $media = $this->getFirstMedia('image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('image');
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

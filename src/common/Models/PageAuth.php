<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModels\BaseInternalMediaModel;

class PageAuth extends BaseInternalMediaModel
{
    protected $table = 'page_auth';
    protected $appends = [
        'side_image', 'side_image_converted',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('side_image')
            ->singleFile();
    }
    public function getSideImageAttribute(): string
    {
        $media = $this->getFirstMedia('side_image');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getSideImageConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('side_image');
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

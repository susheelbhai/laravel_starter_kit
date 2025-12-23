<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModels\BaseInternalMediaModel;

class PageAuth extends BaseInternalMediaModel
{
    protected $table = 'page_auth';
    protected $appends = [
        'side_image',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('side_image')
            ->singleFile();
    }
     public function getSideImageAttribute(): string
    {
        $media = $this->getFirstMedia('side_image');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['side_image'] ?? '';
    }
}

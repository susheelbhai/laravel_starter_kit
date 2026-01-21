<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class PageAbout extends BaseExternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected $table = 'page_about';
    protected array $mediaAttributes = [
        'banner',
        'founder_image',
    ];

    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
}

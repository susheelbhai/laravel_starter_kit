<?php

namespace App\Models;

use App\Models\BaseModels\BaseInternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends BaseInternalMediaModel
{
    use HasDynamicMediaAttributes, HasFactory;

    protected $mediaAttributes = [
        'images',
    ];

    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute);
        }
    }
}

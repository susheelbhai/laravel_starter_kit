<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class Service extends BaseExternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected$mediaAttributes = [
        'display_img',
        'ad_img',
    ];
    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
}

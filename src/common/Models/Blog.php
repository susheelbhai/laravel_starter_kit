<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseExternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes, SoftDeletes;
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

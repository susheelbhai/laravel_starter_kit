<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class Testimonial extends BaseInternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected array $mediaAttributes = [
        'image',
    ];
    
    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
    
}

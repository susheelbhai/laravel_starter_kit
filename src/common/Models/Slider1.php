<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class Slider1 extends BaseExternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected $table = 'slider1';
    protected array $mediaAttributes = [
        'image1',
        'image2',
    ];

    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
}

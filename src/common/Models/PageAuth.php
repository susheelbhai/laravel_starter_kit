<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModels\BaseInternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class PageAuth extends BaseInternalMediaModel
{
    use HasDynamicMediaAttributes;
    protected $table = 'page_auth';
    protected array $mediaAttributes = [
        'side_image',
    ];
    
    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
    
}

<?php

namespace App\Models;

use App\Traits\HasDynamicMediaAttributes;
use App\Models\BaseModels\BaseInternalMediaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageHome extends BaseInternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected $table = 'page_home';
    
    protected array $mediaAttributes = [
        'banner_image',
        'about_image',
        'why_us_image',
    ];
    
    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
    
}

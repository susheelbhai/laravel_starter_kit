<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;
use App\Traits\HasDynamicMediaAttributes;

class Portfolio extends BaseExternalMediaModel
{
    use HasFactory, HasDynamicMediaAttributes;
    protected $table = 'clients';
    protected array $mediaAttributes = ['logo',];    
    public function registerMediaCollections(): void
    {
        foreach ($this->mediaAttributes as $attribute) {
            $this->addMediaCollection($attribute)->singleFile();
        }
    }
    
}

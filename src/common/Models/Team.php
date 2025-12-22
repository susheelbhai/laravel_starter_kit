<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class Team extends BaseInternalMediaModel
{
    use HasFactory;
    protected $table = 'team';
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }
    
    
    public function getImageAttribute(): string
    {
        $media = $this->getFirstMedia('image');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['image'] ?? '';
    }
}

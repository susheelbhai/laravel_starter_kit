<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class Testimonial extends BaseInternalMediaModel
{
    use HasFactory;
    
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

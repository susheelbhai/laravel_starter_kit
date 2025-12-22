<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends BaseMediaModel
{
    use HasFactory;
    protected $table = 'team';
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('internal_media')
            ->singleFile();
    }
    
    public function getMediaModel(): string
    {
        return MediaInternal::class;
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

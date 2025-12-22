<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Portfolio extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'clients';
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->useDisk('external_media')
            ->singleFile();
    }
    
    public function getLogoAttribute(): string
    {
        $media = $this->getFirstMedia('logo');
        if ($media) {
            return $media->getUrl();
        }
        // Fallback to old attribute if exists
        return $this->attributes['logo'] ?? '';
    }
}

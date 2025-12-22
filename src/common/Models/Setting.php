<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseInternalMediaModel;

class Setting extends BaseInternalMediaModel
{
    use HasFactory;
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('favicon')
            ->singleFile();
        
        $this->addMediaCollection('dark_logo')
            ->singleFile();
        
        $this->addMediaCollection('light_logo')
            ->singleFile();
    }

    public function getFaviconAttribute(): string
    {
        $media = $this->getFirstMedia('favicon');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['favicon'] ?? '';
    }

    public function getDarkLogoAttribute(): string
    {
        $media = $this->getFirstMedia('dark_logo');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['dark_logo'] ?? '';
    }

    public function getLightLogoAttribute(): string
    {
        $media = $this->getFirstMedia('light_logo');
        if ($media) {
            return $media->getUrl();
        }
        return $this->attributes['light_logo'] ?? '';
    }
}

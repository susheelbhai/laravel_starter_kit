<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModels\BaseExternalMediaModel;

class Portfolio extends BaseExternalMediaModel
{
    use HasFactory;
    protected $table = 'clients';
    protected $appends = ['logo', 'logo_converted'];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->useDisk('external_media')
            ->singleFile();
    }
    
    public function getLogoAttribute(): string
    {
        $media = $this->getFirstMedia('logo');
        return $media ? $media->getUrl() : '/dummy.png';
    }

    public function getLogoConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('logo');
        if (!$media) {
            return [];
        }
        $urls = [];
        foreach ($media->getGeneratedConversions() as $conversionName => $isGenerated) {
            if ($isGenerated) {
                $urls[$conversionName] = $media->getUrl($conversionName);
            }
        }
        return $urls;
    }
}

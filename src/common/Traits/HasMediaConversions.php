<?php

namespace App\Traits;

use Spatie\Image\Enums\Fit;

trait HasMediaConversions
{
    protected function addDefaultMediaConversions(): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Max, 150, 150)
            ->sharpen(10);

        $this->addMediaConversion('thumbSquare')
            ->fit(Fit::Crop, 150, 150)
            ->sharpen(10);

        // Maintain aspect ratio for other sizes
        $this->addMediaConversion('small')
            ->width(320)
            ->sharpen(5);

        $this->addMediaConversion('medium')
            ->width(640)
            ->sharpen(5);

        $this->addMediaConversion('large')
            ->width(1024)
            ->sharpen(3);

        $this->addMediaConversion('xlarge')
            ->width(1920)
            ->sharpen(2);
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addDefaultMediaConversions();
    }
}

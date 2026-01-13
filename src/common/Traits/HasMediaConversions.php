<?php

namespace App\Traits;

use Spatie\Image\Enums\Fit;

trait HasMediaConversions
{
    protected function addDefaultMediaConversions(): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Max, 150, 150)
            ->sharpen(10)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('thumbSquare')
            ->fit(Fit::Crop, 150, 150)
            ->sharpen(10)
            ->keepOriginalImageFormat();

        // Maintain aspect ratio for other sizes
        $this->addMediaConversion('small')
            ->width(320)
            ->sharpen(5)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('medium')
            ->width(640)
            ->sharpen(5)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('large')
            ->width(1024)
            ->sharpen(3)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('xlarge')
            ->width(1920)
            ->sharpen(2)
            ->keepOriginalImageFormat();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addDefaultMediaConversions();
    }
}

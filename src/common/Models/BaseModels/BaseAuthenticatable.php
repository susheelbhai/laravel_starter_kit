<?php

namespace App\Models\BaseModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasMediaConversions;
use App\Traits\HasFormattedDates;

abstract class BaseAuthenticatable extends Authenticatable implements HasMedia
{
    use InteractsWithMedia, HasMediaConversions, HasFormattedDates {
        HasMediaConversions::registerMediaConversions insteadof InteractsWithMedia;
    }

     /**
     * Get the URL for the first media item in a collection.
     *
     * @param string $collection
     * @param string $default
     * @return string
     */
    protected function getMediaUrl(string $collection, string $default = '/dummy.png'): string
    {
        $media = $this->getFirstMedia($collection);
        return $media ? $media->getUrl() : $default;
    }

    /**
     * Get an array of URLs for generated conversions.
     *
     * @param string $collection
     * @return array
     */
    protected function getMediaConvertedUrls(string $collection): array
    {
        $media = $this->getFirstMedia($collection);
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

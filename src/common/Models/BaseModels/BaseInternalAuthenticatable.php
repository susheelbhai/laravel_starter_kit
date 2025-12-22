<?php

namespace App\Models\BaseModels;

use Spatie\MediaLibrary\MediaCollections\MediaCollection;
use App\Models\MediaInternal;

abstract class BaseInternalAuthenticatable extends BaseAuthenticatable
{
    public function getMediaModel(): string
    {
        return MediaInternal::class;
    }

    public function addMediaCollection(string $name): MediaCollection
    {
        return parent::addMediaCollection($name)->useDisk('internal_media');
    }
}

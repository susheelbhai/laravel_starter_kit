<?php

namespace App\Models\BaseModels;

use Spatie\MediaLibrary\MediaCollections\MediaCollection;
use App\Models\MediaInternal;

abstract class BaseInternalMediaModel extends BaseMediaModel
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

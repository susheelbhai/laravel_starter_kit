<?php

namespace App\Models\BaseModels;

use Spatie\MediaLibrary\MediaCollections\MediaCollection;
use App\Models\MediaExternal;

abstract class BaseExternalMediaModel extends BaseMediaModel
{
    public function getMediaModel(): string
    {
        return MediaExternal::class;
    }

    public function addMediaCollection(string $name): MediaCollection
    {
        return parent::addMediaCollection($name)->useDisk('external_media');
    }
}

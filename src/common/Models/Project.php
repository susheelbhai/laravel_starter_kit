<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDynamicMediaAttributes;
use App\Models\BaseModels\BaseExternalMediaModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends BaseExternalMediaModel
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, HasDynamicMediaAttributes;
    protected $appends = ['images', 'ad_img'];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('ad_img');
    }

    public function images(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getMedia('images')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                    'thumbnail' => $media->getUrl('thumb'),
                    'name' => $media->name,
                    'file_name' => $media->file_name,
                    'size' => $media->size,
                    'mime_type' => $media->mime_type,
                ];
            }),
        );
    }

    public function getAdImgAttribute(): string
    {
        $media = $this->getFirstMedia('ad_img');
        return $media ? $media->getUrl() : '/dummy.png';
    }
}

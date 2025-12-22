<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasMediaConversions;

abstract class BaseMediaModel extends Model implements HasMedia
{
    use InteractsWithMedia, HasMediaConversions {
        HasMediaConversions::registerMediaConversions insteadof InteractsWithMedia;
    }
}

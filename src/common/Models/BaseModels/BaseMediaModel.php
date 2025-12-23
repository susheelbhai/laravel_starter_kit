<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasMediaConversions;
use App\Traits\HasFormattedDates;

abstract class BaseMediaModel extends Model implements HasMedia
{
    use InteractsWithMedia, HasMediaConversions, HasFormattedDates {
        HasMediaConversions::registerMediaConversions insteadof InteractsWithMedia;
    }
}

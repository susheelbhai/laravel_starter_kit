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
}

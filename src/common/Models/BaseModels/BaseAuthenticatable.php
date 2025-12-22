<?php

namespace App\Models\BaseModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasMediaConversions;

abstract class BaseAuthenticatable extends Authenticatable implements HasMedia
{
    use InteractsWithMedia, HasMediaConversions {
        HasMediaConversions::registerMediaConversions insteadof InteractsWithMedia;
    }
}

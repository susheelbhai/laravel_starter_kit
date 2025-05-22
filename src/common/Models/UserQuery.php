<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{
    use HasFactory;

    public function status()
    {
       return $this->belongsTo(UserQueryStatus::class,'status_id');
    }
}

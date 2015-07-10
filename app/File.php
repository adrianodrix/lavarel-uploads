<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class File extends Model
{
    /*
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}

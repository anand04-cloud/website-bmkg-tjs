<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buletin extends Model
{
    protected $guarded = [];

    protected $casts = [
        'publish_time' => 'datetime',
    ];
}

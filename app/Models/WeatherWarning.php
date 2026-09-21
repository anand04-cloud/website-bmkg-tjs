<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherWarning extends Model
{
    protected $fillable = [
        'title',
        'content',
        'publish_time',
        'link',
    ];

    protected $casts = [
        'publish_time' => 'datetime',
    ];
}

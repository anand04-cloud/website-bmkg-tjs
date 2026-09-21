<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earthquake extends Model
{
    protected $fillable = [
        'tgl', 
        'jam', 
        'datetime', 
        'coordinates', 
        'magnitude', 
        'kedalaman', 
        'wilayah', 
        'potensi', 
        'dirasakan', 
        'shakemap'
    ];

    protected $casts = [
        'occurrence_time' => 'datetime',
    ];
}

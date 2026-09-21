<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirQuality extends Model
{
    //nama tabel jamak jika di migrasi menggunakan 'air_qualities'
    protected $table = 'air_qualities';

    protected $fillable = [ 
        'station_name', 
        'aqi_value',
        'pm25', 
        'category', 
        'measured_at'
    ];

    // Opsional: Casting agar measured_at otomatis jadi objek Carbon/Datetime
    protected $casts = [
        'measured_at' => 'datetime',
    ];
}

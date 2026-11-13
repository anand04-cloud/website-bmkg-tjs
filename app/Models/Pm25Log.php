<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pm25Log extends Model
{
    protected $table = 'pm25_measurements'; // Sesuaikan dengan nama tabel aslimu
    protected $guarded = [];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pm25Log extends Model
{
    protected $connection = 'mysql_cms'; // Sesuaikan dengan koneksi database
    protected $table = 'pm25_measurements'; // Sesuaikan dengan nama tabel aslimu
    protected $guarded = [];
}
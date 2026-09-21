<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'harga',
        'satuan_harga',
        'icon_image',
        'gform_url',
    ];
    
}

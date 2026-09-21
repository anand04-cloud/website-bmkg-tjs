<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'section_title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

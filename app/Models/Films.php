<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'released_at',
        'src',
        'trailer_src',
        'poster',
        'thumbnail',
        'rating',
        'duration',
    ];
}

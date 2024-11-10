<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memorie extends Model
{
    protected $fillable = [
        'uid',
        'm_id',
        'memory_image',
    ];
}

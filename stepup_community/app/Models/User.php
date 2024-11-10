<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'uid',
        'name',
        'phone',
        'email',
        'google_id',
        'avatar',
    ];
}

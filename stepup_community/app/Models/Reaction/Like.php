<?php

namespace App\Models\Reaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'uid',
        'p_id',
    ];

    public function getUserForLike() {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

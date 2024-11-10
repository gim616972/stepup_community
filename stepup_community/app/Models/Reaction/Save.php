<?php

namespace App\Models\Reaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $fillable = [
        'uid',
        'p_id',
    ];

    // get post by save
    public function getUserForSave() {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}

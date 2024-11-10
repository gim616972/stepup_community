<?php

namespace App\Models\Reaction;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'uid',
        'com_id',
        'p_id',
        'comment',
        'parent_id',
    ];

    // coment user
    public function commentUser() {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
    
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }
}

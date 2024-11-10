<?php

namespace App\Models;

use App\Models\Reaction\Comment;
use App\Models\Reaction\Like;
use App\Models\Reaction\Replay;
use App\Models\Reaction\Save;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'uid',
        'p_id',
        'category',
        'post_image',
        'post_content',
    ];

    // find post user
    public function users() {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }

    // get all likes by post
    public function likes() {
        return $this->hasMany(Like::class, 'p_id', 'p_id');
    }

    // get all comment
    public function comment() {
        return $this->hasMany(Comment::class, 'p_id', 'p_id');
    }

    // get comment and replies
    public function comments() {
        return $this->hasMany(Comment::class, 'p_id', 'p_id')->whereNull('parent_id')->with('replies');
    }

    // get all save
    public function saves() {
        return $this->hasMany(Save::class, 'p_id', 'p_id');
    }
}

<?php

namespace App\Http\Controllers\Reaction;

use App\Http\Controllers\Controller;
use App\Models\Reaction\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost(Request $request) {
        $post_id = $request->post_id;
        $user_uid = Auth::user()->uid;
        $existingLike = Like::where('uid', $user_uid)->where('p_id', $post_id)->first();
        if (!$existingLike) {
            $like = Like::create([
                'uid'=>$user_uid,
                'p_id'=>$post_id,
            ]);
            if ($like) {
                return response()->json(["message"=>"success"]);
            }
        }
    }
}

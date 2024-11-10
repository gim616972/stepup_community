<?php

namespace App\Http\Controllers\Reaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reaction\Save;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    // post save
    public function savePost(Request $request) {
        $post_id = $request->post_id;
        $user_uid = Auth::user()->uid;
        $existingSave = Save::where('uid', $user_uid)->where('p_id', $post_id)->first();
        if (!$existingSave) {
            $save = Save::create([
                'uid'=>$user_uid,
                'p_id'=>$post_id,
            ]);
            if ($save) {
                return response()->json(["message"=>"success"]);
            }
        }
    }

    // post unsave
    public function unsavePost(Request $request) {
        $post_id = $request->post_id;
        $user_uid = Auth::user()->uid;
        $existingSave = Save::where('uid', $user_uid)->where('p_id', $post_id)->first();
        if ($existingSave) {
            $unsave = $existingSave->delete();
            if ($unsave) {
                return response()->json(["message"=>"success"]);
            }
        }
    }
    
}

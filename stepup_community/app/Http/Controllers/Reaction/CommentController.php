<?php

namespace App\Http\Controllers\Reaction;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Reaction\Comment;
use App\Http\Controllers\Controller;
use App\Models\Reaction\Like;
use App\Models\Reaction\Save;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function loadComment(Request $request) {
        $post_id      = $request->post_id;
        $user_uid     = Auth::user()->uid;
        $postComment  = Post::where(function ($query) {
                            $query->where('status', '!=', 1)
                            ->where('status', '!=', 4);
                        })
                        ->where('p_id',$post_id)
                        ->with(['users', 'comments.commentUser', 'comments.replies.commentUser'])
                        ->withCount(['likes', 'saves'])->first();
        if (!$postComment) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $html = view('Render.comments', compact('postComment'))->render();
        return response()->json(['html' => $html]);
    }

    // save comment
    public function saveComment(Request $request) {
        $post_id   = $request->post_id;
        $comment   = $request->comment;
        $user_uid  = Auth::user()->uid;
        $user_name = Auth::user()->name;
        $user_img  = Auth::user()->avatar;
        $uniqueCom = "COM_".uniqid();
        
        $validatedData = $request->validate([
            'post_id' => 'required|string',
            'comment' => 'required|string',
            'parent_id' => 'nullable',
        ]);

        $isComment = Comment::create([
            'uid' => $user_uid,
            'com_id' => $uniqueCom,
            'p_id' => $post_id,
            'comment' => $comment,
        ]);
        if ($isComment) {
            $user_uid     = Auth::user()->uid;
            $loadComment  = Post::where(function ($query) {
                                $query->where('status', '!=', 1)
                                ->where('status', '!=', 4);
                            })
                            ->where('p_id',$post_id)
                            ->with(['users', 'comments.commentUser', 'comments.replies.commentUser'])->first();
            if (!$loadComment) {
                return response()->json(['message' => 'Post not found !']);
            }

            $html = view('Render.loadComments', compact('loadComment'))->render();

            return response()->json(['message'=>'success','html'=>$html]);
        } else {
            return response()->json(['message' => 'Please try after sometime !']);
        }
    }

    // save reply
    public function saveReply(Request $request) {
        $post_id    = $request->post_id;
        $comment_id = $request->comment_id;
        $reply_text = $request->reply_text;
        $user_uid   = Auth::user()->uid;
        $user_name  = Auth::user()->name;
        $user_img   = Auth::user()->avatar;
        $uniqueRep  = "COM_".uniqid();

        $validatedData = $request->validate([
            'post_id' => 'required|string',
            'comment_id' => 'required|string',
            'reply_text' => 'required|string',
        ]);

        $parentComment = Comment::where('com_id', $comment_id)->first();
        if ($parentComment) {
            $parent_id = $parentComment->id;
            $isSavedReply = Comment::create([
                'uid' => $user_uid,
                'com_id' => $uniqueRep,
                'p_id' => $post_id,
                'comment' => $reply_text,
                'parent_id' => $parent_id,
            ]);
            if ($isSavedReply) {
                $user_uid     = Auth::user()->uid;
                $loadComment  = Post::where(function ($query) {
                                    $query->where('status', '!=', 1)
                                    ->where('status', '!=', 4);
                                })
                                ->where('p_id',$post_id)
                                ->with(['users', 'comments.commentUser', 'comments.replies.commentUser'])->first();
                if (!$loadComment) {
                    return response()->json(['message' => 'Post not found !']);
                }

                $html = view('Render.loadComments', compact('loadComment'))->render();

                return response()->json(['message'=>'success','html'=>$html]);
            }
        } else {
            return response()->json(['message' => 'Please try after sometime !']);
        }
        
    }
}

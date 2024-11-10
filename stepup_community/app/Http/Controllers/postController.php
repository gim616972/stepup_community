<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    // create post
    public function addPost(Request $request) {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'post_content' => 'required|string',
            'pos_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $userId = Auth::user()->uid;
        $uniquePid = "PID_".uniqid();
        $data = [
            'uid' => $userId,
            'p_id' => $uniquePid,
            'category' => $validatedData['category'],
            'post_content' => $validatedData['post_content'],
        ];

        if ($request->hasFile('pos_image')) {
            $image = $request->file('pos_image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('postImage'), $imageName);
            $data['post_image'] = $imageName;
        }

        $createPost = Post::create($data);
        if ($createPost) {
            return response()->json(['message' => 'Post created successfully!']);
        } else {
            return response()->json(['message' => 'Faild to create Post!']);
        }
    }

    // show post
    public function loadPosts(Request $request) {
        $userId = Auth::user()->uid;
        $posts = Post::where('status',2)
                    ->with(['users', 'likes', 'saves'])
                    ->withCount(['likes', 'comment'])
                    ->orderBy('posts.created_at', 'desc')->paginate(5)
                    ->map(function ($post) use ($userId) {
                        $post->user_has_liked = $post->likes->contains('uid', $userId);
                        $post->user_has_saved = $post->saves->contains('uid', $userId);
                        return $post;
                    });
        if (!$posts) {
            return response()->json(['message'=>'No Post Found !']);
        }
        $html = view('Render.post', compact(['posts']))->render();
        if (!$html) {
            return response()->json(['message'=>'No Post Found !']);
        } else {
            return response()->json(['message'=>'success','html' => $html]);
        }
    }
}

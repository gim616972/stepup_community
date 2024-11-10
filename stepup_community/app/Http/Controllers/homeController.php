<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Memorie;
use App\Models\Reaction\Comment;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    // dashboard page
    public function dashboard() {
        $userId = Auth::user()->uid;
        $pinPost = Post::where('status',3)
                    ->with(['users', 'likes', 'saves'])
                    ->withCount(['likes', 'comment'])->get()
                    ->map(function ($post) use ($userId) {
                        $post->user_has_liked = $post->likes->contains('uid', $userId);
                        $post->user_has_saved = $post->saves->contains('uid', $userId);
                        return $post;
                    });
        $maxReactionPost = Post::where('status',2)->join('users','posts.uid','users.uid')->get();
        $memoryData = Memorie::where('memories.created_at', '>=', now()->subDay())->join('users','memories.uid','users.uid')->get();
        return view('dashboard', compact(['pinPost','maxReactionPost','memoryData']));
    }

    // profile page
    public function profile() {
        $user_image = Auth::user()->avatar;
        $user_name  = Auth::user()->name;
        $user_email = Auth::user()->email;
        $user_phone = Auth::user()->phone;
        return view('userProfile', compact(['user_image', 'user_name', 'user_email', 'user_phone']));
    }

    // saved post page
    public function savedPost() {
        $savedPost = Post::where('status',3)->join('users','posts.uid','users.uid')->get();
        return view('savedPost', compact('savedPost'));
    }
}

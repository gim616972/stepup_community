<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\memoryController;
use App\Http\Controllers\postController;
use App\Http\Controllers\Reaction\CommentController;
use App\Http\Controllers\Reaction\LikeController;
use App\Http\Controllers\Reaction\SaveController;
use App\Http\Middleware\ValidateUser;

// access without login
Route::middleware('guest')->group(function(){
    // login section
    Route::get('/login', [loginController::class, 'loginPage'])->name('loginPage');
    Route::get('/loginWithGoogle', [loginController::class, 'googleLogin'])->name('google_login');
    Route::get('/userLogin', [loginController::class, 'userLogin'])->name('user_login');
});

// need to login
Route::middleware([ValidateUser::class])->group(function () {
    Route::get('/', [homeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [homeController::class, 'profile'])->name('profile');
    Route::get('/saved-post', [homeController::class, 'savedPost'])->name('savedPost');

    // add post
    Route::post('/addPost', [postController::class, 'addPost'])->name('addPost');
    Route::post('/addMemory', [memoryController::class, 'addMemory'])->name('addMemory');
    Route::get('/load-posts', [postController::class, 'loadPosts'])->name('loadPosts');
    Route::get('/load-memory', [memoryController::class, 'loadMemory'])->name('loadMemory');

    // reaction
    Route::get('/like-post', [LikeController::class, 'likePost'])->name('likePost');
    Route::get('/save-post', [SaveController::class, 'savePost'])->name('savePost');
    Route::get('/unsave-post', [SaveController::class, 'unsavePost'])->name('unsavePost');
    Route::get('/load-comment', [CommentController::class, 'loadComment'])->name('loadComment');
    Route::post('/save-comment', [CommentController::class, 'saveComment'])->name('saveComment');
    Route::post('/save-reply', [CommentController::class, 'saveReply'])->name('saveReply');

    // log out section
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
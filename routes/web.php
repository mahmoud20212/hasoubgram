<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/user/{user:username}", [UserController::class, 'index'])->name('user.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('posts.index');
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::post('/posts', 'store')->name('posts.store');
        Route::get('/posts/{post:slug}', 'show')->name('posts.show');
        Route::get('/posts/{post:slug}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{post}', 'update')->name('posts.update');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
        Route::get('/explore', 'explore')->name('explore');
    });

    Route::post('/posts/{post:slug}/comment', [CommentController::class, 'store']);
    Route::get('/posts/{post:slug}/like', LikeController::class)->name('posts.like');
    Route::get('/follow/{user:username}', [FollowController::class, 'follow'])->name('follow');
    Route::get('/unfollow/{user:username}', [FollowController::class, 'unfollow'])->name('unfollow');
});

require __DIR__.'/auth.php';

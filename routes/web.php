<?php

// routes/web.php
// This preserves your existing Breeze setup and adds blog functionality

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breeze authentication routes (keep this line)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| NEW BLOG ROUTES (Added to existing Breeze)
|--------------------------------------------------------------------------
*/

// Public blog routes
Route::prefix('blog')->group(function () {
    // Posts
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    // Categories
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    // Search
    Route::get('/search', SearchController::class)->name('search');

});

//blog routes
Route::middleware('auth')->prefix('blog')->group(function () {
    // Post management
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
    // Post owner only
    Route::middleware('post.owner')->group(function () {
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    // Comment
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

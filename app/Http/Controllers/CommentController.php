<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['post_id'] = $post->id;

        $post->comments()->create($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post = $comment->post;
        $comment->delete();

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Comment deleted successfully!');
    }
}

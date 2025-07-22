<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'categories'])
            ->published()
            ->latest();

        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->search($searchTerm);
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        $posts = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);

        $post = Post::create($validated);

        if ($request->has('category_id')) {
            $post->categories()->sync([$request->category_id]);
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        if ($post->status === 'draft' && $post->user_id !== Auth::id()) {
            abort(404);
        }

        $post->load(['user', 'categories', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own posts.');
        }

        $categories = Category::all();
        $selectedCategory = $post->categories->first()->id ?? $categories->first()->id ?? null;

        return view('posts.edit', compact('post', 'categories', 'selectedCategory'));
    }

    public function saveDraft(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own posts.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['status'] = 'draft';

        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        if ($request->has('category_id') && $request->category_id) {
            $post->categories()->sync([$request->category_id]);
        }

        return redirect()
            ->route('posts.show', $post->fresh()->slug)
            ->with('success', 'Post saved as draft successfully!');
    }

    public function publishPost(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own posts.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['status'] = 'published';

        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        if ($request->has('category_id') && $request->category_id) {
            $post->categories()->sync([$request->category_id]);
        }

        return redirect()
            ->route('posts.show', $post->fresh()->slug)
            ->with('success', 'Post published successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only delete your own posts.');
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    public function myPosts()
    {
        $posts = Auth::user()
            ->posts()
            ->with('categories')
            ->latest()
            ->paginate(10);

        return view('posts.my-posts', compact('posts'));
    }
}

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
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('post.owner')->only(['edit', 'update', 'destroy']);
    }

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

        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
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
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
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

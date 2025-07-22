<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_posts' => $user->posts()->count(),
            'published_posts' => $user->posts()->where('status', 'published')->count(),
            'draft_posts' => $user->posts()->where('status', 'draft')->count(),
            'total_comments' => $user->comments()->count(),
        ];

        $recent_posts = $user->posts()
            ->with('categories')
            ->latest()
            ->limit(5)
            ->get();

        $recent_comments = $user->comments()
            ->with('post')
            ->latest()
            ->limit(5)
            ->get();

        $categories = Category::all();

        $posts = $user->posts()
            ->with('categories')
            ->latest()
            ->paginate(9);

        return view('posts.dashboard', compact('stats', 'recent_posts', 'recent_comments', 'categories', 'posts'));
    }
}

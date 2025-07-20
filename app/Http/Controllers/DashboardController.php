<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        return view('dashboard', compact('stats', 'recent_posts', 'recent_comments'));
    }
}

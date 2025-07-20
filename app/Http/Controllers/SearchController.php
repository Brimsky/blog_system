<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100'
        ]);

        $searchTerm = $request->get('q');

        $posts = Post::with(['user', 'categories'])
            ->published()
            ->search($searchTerm)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('posts.search', compact('posts', 'categories', 'searchTerm'));
    }
}

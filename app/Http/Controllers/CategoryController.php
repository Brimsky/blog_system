<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()
            ->with(['user', 'categories'])
            ->published()
            ->latest()
            ->paginate(10);

        return view('categories.show', compact('category', 'posts'));
    }

    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return response()->json($categories);
    }
}

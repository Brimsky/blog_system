{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Welcome to TechBlog
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Discover insights, tutorials, and thoughts from developers, entrepreneurs, and tech enthusiasts around the world.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Browse Posts
                </a>
                @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-blue-600 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Start Writing
                    </a>
                @else
                    <a href="{{ route('posts.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-blue-600 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Write a Post
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
@php
    $totalPosts = \App\Models\Post::published()->count();
    $totalUsers = \App\Models\User::count();
    $totalComments = \App\Models\Comment::count();
    $totalCategories = \App\Models\Category::count();
@endphp
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl font-bold text-blue-600">{{ $totalPosts }}</div>
                <div class="text-gray-600 mt-2">Published Posts</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-600">{{ $totalUsers }}</div>
                <div class="text-gray-600 mt-2">Writers</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-purple-600">{{ $totalComments }}</div>
                <div class="text-gray-600 mt-2">Comments</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-orange-600">{{ $totalCategories }}</div>
                <div class="text-gray-600 mt-2">Categories</div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Posts Section -->
@php
    $featuredPosts = \App\Models\Post::with(['user', 'categories', 'comments'])
        ->published()
        ->latest()
        ->take(6)
        ->get();
@endphp
@if($featuredPosts->count() > 0)
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Posts</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover the most recent insights and stories from our community of writers.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPosts as $post)
                    <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 ease-in-out">
                        <div class="p-6">
                            @if($post->categories->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($post->categories->take(2) as $category)
                                        <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="hover:text-blue-600 transition duration-150 ease-in-out">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->body), 120) }}
                            </p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <div class="h-6 w-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-medium">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                                <span>{{ $post->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>

                        <div class="px-6 pb-6">
                            <a href="{{ route('posts.show', $post) }}"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                    View All Posts
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endif

<!-- Categories Section -->
@php
    $categories = \App\Models\Category::withCount(['posts' => function($query) {
        $query->published();
    }])->get();
@endphp
@if($categories->count() > 0)
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Explore Categories</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Browse posts by topic and discover content that interests you most.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}"
                       class="group block p-6 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition duration-150 ease-in-out text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 mb-1">
                            {{ $category->name }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

<!-- Call to Action Section -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            @guest
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Share Your Story?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join our community of writers and start sharing your insights, experiences, and knowledge with the world.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Sign Up Now
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-blue-600 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In
                    </a>
                </div>
            @else
                <h2 class="text-3xl font-bold text-white mb-4">Welcome back, {{ Auth::user()->name }}!</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Ready to share your next great idea? Your audience is waiting to hear from you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('posts.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Write New Post
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-blue-600 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        View Dashboard
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose TechBlog?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Everything you need to share your knowledge and connect with fellow tech enthusiasts.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Writing</h3>
                <p class="text-gray-600">
                    Simple, intuitive editor that lets you focus on your content. Write, edit, and publish with ease.
                </p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Engaged Community</h3>
                <p class="text-gray-600">
                    Connect with readers through comments and discussions. Build your audience and network.
                </p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Discover Content</h3>
                <p class="text-gray-600">
                    Powerful search and category system to help readers find exactly what they're looking for.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

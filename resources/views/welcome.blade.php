@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-8 space-y-8">
        <section class="text-center space-y-4 py-12">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Welcome to TechBlog
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover insights, tutorials, and stories from industry experts.
                Stay ahead with the latest trends in technology, lifestyle, and more.
            </p>
        </section>

        @php
            $featuredPosts = \App\Models\Post::with(['user', 'categories', 'comments'])
                ->published()
                ->latest()
                ->take(2)
                ->get();
        @endphp
        @if($featuredPosts->count() > 0)
            <section class="space-y-6">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Featured Posts</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($featuredPosts as $post)
                        <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow cursor-pointer group">
                            <div class="p-6 space-y-4">
                                <div class="flex items-center gap-2">
                                    @if($post->categories->count() > 0)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $post->categories->first()->name }}
                                        </span>
                                    @endif
                                    <span class="text-sm text-blue-600 font-medium">Featured</span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h3>

                                <p class="text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->body), 120) }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            {{ $post->user->name }}
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $post->created_at->format('M j, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @php
            $recentPosts = \App\Models\Post::with(['user', 'categories', 'comments'])
                ->published()
                ->latest()
                ->skip(2)
                ->take(6)
                ->get();
        @endphp
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Recent Posts</h2>
                <span class="text-sm text-gray-500">{{ $recentPosts->count() }} posts found</span>
            </div>

            @if($recentPosts->count() === 0)
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-12 text-center space-y-4">
                        <svg class="h-12 w-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900">No posts found</h3>
                        <p class="text-gray-600">Be the first to write a post!</p>
                        @auth
                            <a href="{{ route('posts.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-full transition-all duration-200">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Post
                            </a>
                        @endauth
                    </div>
                </div>
            @else
                <div class="grid gap-6">
                    @foreach($recentPosts as $post)
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow cursor-pointer group">
                            <div class="p-6">
                                <div class="grid md:grid-cols-4 gap-6">
                                    <div class="md:col-span-3 space-y-4">
                                        <div class="flex items-center gap-2">
                                            @if($post->categories->count() > 0)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border">
                                                    {{ $post->categories->first()->name }}
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                        </h3>

                                        <p class="text-gray-600 line-clamp-2">
                                            {{ Str::limit(strip_tags($post->body), 120) }}
                                        </p>

                                        @if($post->categories->count() > 1)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($post->categories->skip(1)->take(3) as $category)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-600">
                                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-1">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    {{ $post->user->name }}
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $post->created_at->format('M j, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        @if($recentPosts->count() > 0)
            <div class="text-center">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                    View All Posts
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endif
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

    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }

    .text-transparent {
        color: transparent;
    }

    .backdrop-blur {
        backdrop-filter: blur(8px);
    }

    @supports (backdrop-filter: blur(8px)) {
        .supports-\[backdrop-filter\]\:bg-white\/80 {
            background-color: rgba(255, 255, 255, 0.8);
        }
    }
</style>
@endsection

{{-- resources/views/posts/index.blade.php --}}
@extends('layouts.app')

@section('title', '- All Posts')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Latest Blog Posts</h1>
        <p class="text-xl text-gray-600">Discover insights, tutorials, and thoughts from our community</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search Form -->
            <div class="flex-1">
                <form action="{{ route('posts.index') }}" method="GET" class="flex">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search posts by title or content..."
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Category Filter -->
            <div class="md:w-64">
                <form action="{{ route('posts.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="category"
                            onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}"
                                    {{ request('category') === $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <!-- Active Filters -->
        @if(request('search') || request('category'))
            <div class="mt-4 flex flex-wrap gap-2">
                @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                        Search: "{{ request('search') }}"
                        <a href="{{ route('posts.index', array_filter(['category' => request('category')])) }}"
                           class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </span>
                @endif
                @if(request('category'))
                    @php
                        $selectedCategory = $categories->firstWhere('slug', request('category'));
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        Category: {{ $selectedCategory->name ?? request('category') }}
                        <a href="{{ route('posts.index', array_filter(['search' => request('search')])) }}"
                           class="ml-2 text-green-600 hover:text-green-800">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </span>
                @endif
            </div>
        @endif
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 ease-in-out">
                    <!-- Post Header -->
                    <div class="p-6">
                        <!-- Categories -->
                        @if($post->categories->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($post->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}"
                                       class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition duration-150 ease-in-out">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            <a href="{{ route('posts.show', $post) }}"
                               class="hover:text-blue-600 transition duration-150 ease-in-out">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->body), 150) }}
                        </p>

                        <!-- Post Meta -->
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span>{{ $post->comments->count() }}</span>
                                </div>
                                <span>{{ $post->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Read More Button -->
                    <div class="px-6 pb-6">
                        <a href="{{ route('posts.show', $post) }}"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-150 ease-in-out">
                            Read more
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $posts->links('pagination.custom') }}
        </div>
    @else
        <!-- No Posts Found -->
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No posts found</h3>
            <p class="mt-2 text-gray-500">
                @if(request('search') || request('category'))
                    Try adjusting your search criteria or
                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-500">view all posts</a>.
                @else
                    Be the first to share your thoughts!
                    @auth
                        <a href="{{ route('posts.create') }}" class="text-blue-600 hover:text-blue-500">Create a post</a>.
                    @else
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500">Sign up</a> to create a post.
                    @endauth
                @endif
            </p>
        </div>
    @endif
</div>

<!-- Custom CSS for line clamping -->
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

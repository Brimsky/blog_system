@extends('layouts.app')

@section('title', "- {$category->name} Posts")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Category Header -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Category
        </div>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">{{ $category->description }}</p>
        @endif
        <div class="mt-4 text-sm text-gray-500">
            {{ $posts->total() }} {{ Str::plural('post', $posts->total()) }} in this category
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            <li>
                <div>
                    <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span class="sr-only">Home</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('posts.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">All Posts</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-900">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

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
                                @foreach($post->categories as $postCategory)
                                    <a href="{{ route('categories.show', $postCategory) }}"
                                       class="inline-block px-2 py-1 text-xs font-medium rounded-full transition duration-150 ease-in-out {{ $postCategory->id === $category->id ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">
                                        {{ $postCategory->name }}
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
            <h3 class="mt-4 text-lg font-medium text-gray-900">No posts in this category yet</h3>
            <p class="mt-2 text-gray-500">
                Be the first to create a post in the {{ $category->name }} category!
                @auth
                    <a href="{{ route('posts.create') }}" class="text-blue-600 hover:text-blue-500 font-medium">Create a post</a>.
                @else
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign up</a> to create a post.
                @endauth
            </p>
            <div class="mt-6">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Browse All Posts
                </a>
            </div>
        </div>
    @endif

    <!-- Other Categories -->
    @php
        $otherCategories = \App\Models\Category::where('id', '!=', $category->id)->withCount('posts')->get();
    @endphp
    @if($otherCategories->count() > 0)
        <div class="mt-16 bg-gray-50 rounded-lg p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Explore Other Categories</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($otherCategories as $otherCategory)
                    <a href="{{ route('categories.show', $otherCategory) }}"
                       class="block p-4 bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition duration-150 ease-in-out">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $otherCategory->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $otherCategory->posts_count }} {{ Str::plural('post', $otherCategory->posts_count) }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
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

@extends('layouts.app')

@section('title', "- Search Results for \"{$searchTerm}\"")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Search Results</h1>
        <p class="text-lg text-gray-600">
            Found {{ $posts->total() }} {{ Str::plural('result', $posts->total()) }} for
            <span class="font-semibold text-gray-900">"{{ $searchTerm }}"</span>
        </p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="q" class="sr-only">Search</label>
                <input type="text"
                       name="q"
                       id="q"
                       value="{{ $searchTerm }}"
                       placeholder="Search posts by title or content..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                <svg class="h-5 w-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
        </form>
    </div>

    @if($posts->count() > 0)
        <div class="space-y-6 mb-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-6">
                        <div class="flex-1">
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

                            <h2 class="text-xl font-bold text-gray-900 mb-3">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="hover:text-blue-600 transition duration-150 ease-in-out">
                                    {!! str_ireplace($searchTerm, '<mark class="bg-yellow-200 px-1 rounded">' . $searchTerm . '</mark>', e($post->title)) !!}
                                </a>
                            </h2>

                            <div class="text-gray-600 mb-4">
                                @php
                                    $excerpt = Str::limit(strip_tags($post->body), 200);
                                    $highlightedExcerpt = str_ireplace($searchTerm, '<mark class="bg-yellow-200 px-1 rounded">' . $searchTerm . '</mark>', e($excerpt));
                                @endphp
                                <p>{!! $highlightedExcerpt !!}</p>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $post->created_at->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 lg:mt-0 lg:flex-shrink-0">
                            <a href="{{ route('posts.show', $post) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                                Read Full Post
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="flex justify-center">
            {{ $posts->appends(['q' => $searchTerm])->links('pagination.custom') }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No results found</h3>
            <p class="mt-2 text-gray-500 max-w-md mx-auto">
                We couldn't find any posts matching "<span class="font-semibold">{{ $searchTerm }}</span>".
                Try adjusting your search terms or browse our categories.
            </p>

            <div class="mt-6 space-y-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Search Tips:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Try different keywords or phrases</li>
                        <li>• Check your spelling</li>
                        <li>• Use more general terms</li>
                        <li>• Browse by categories below</li>
                    </ul>
                </div>

                <div class="flex flex-wrap justify-center gap-3 mt-6">
                    <a href="{{ route('posts.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Browse All Posts
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if($categories->count() > 0)
        <div class="mt-12 bg-gray-50 rounded-lg p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Browse by Category</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}"
                       class="block p-4 bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition duration-150 ease-in-out">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $category->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $category->posts()->published()->count() }} posts</p>
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

    @if($posts->count() === 0)
        @php
            $recentPosts = \App\Models\Post::with(['user', 'categories'])->published()->latest()->take(3)->get();
        @endphp
        @if($recentPosts->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Recent Posts You Might Like</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recentPosts as $recentPost)
                        <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 ease-in-out">
                            <div class="p-6">
                                @if($recentPost->categories->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($recentPost->categories->take(2) as $category)
                                            <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('posts.show', $recentPost) }}"
                                       class="hover:text-blue-600 transition duration-150 ease-in-out">
                                        {{ $recentPost->title }}
                                    </a>
                                </h4>

                                <p class="text-gray-600 text-sm mb-3">
                                    {{ Str::limit(strip_tags($recentPost->body), 100) }}
                                </p>

                                <div class="flex items-center text-xs text-gray-500">
                                    <span>{{ $recentPost->user->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $recentPost->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>
@endsection

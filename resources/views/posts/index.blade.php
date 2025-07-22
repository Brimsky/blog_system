@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6">
    <div class="mb-12 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Latest Blog Posts</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Insights, tutorials, and community perspectives</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mb-10">
        <form class="flex-1 flex" action="{{ route('posts.index') }}" method="GET">
            <div class="relative flex-1">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search posts..."
                    class="w-full pl-4 pr-12 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                />
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>

        <form class="sm:w-56" action="{{ route('posts.index') }}" method="GET">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <select
                name="category"
                onchange="this.form.submit()"
                class="w-full py-3 pl-4 pr-10 bg-white border border-gray-200 rounded-xl text-base focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGZpbGw9Im5vbmUiIHZpZXdCb3g9IjAgMCAyNCAyNCIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHBhdGggc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjIiIGQ9Ik04IDlsNiA2IDYtNiIvPjwvc3ZnPg==')] bg-no-repeat bg-[center_right_1rem]"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if(request('search') || request('category'))
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            @if(request('search'))
                <span class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-xl text-sm font-medium">
                    "{{ request('search') }}"
                    <a href="{{ route('posts.index', array_filter(['category' => request('category')])) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </span>
            @endif
            @if(request('category'))
                @php $selectedCategory = $categories->firstWhere('slug', request('category')); @endphp
                <span class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-xl text-sm font-medium">
                    {{ $selectedCategory->name ?? request('category') }}
                    <a href="{{ route('posts.index', array_filter(['search' => request('search')])) }}" class="ml-2 text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </span>
            @endif
        </div>
    @endif

    <div class="mb-16">
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all hover:shadow-lg">
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($post->categories as $category)
                                    <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 leading-snug">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 mb-5 line-clamp-3">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="text-sm font-medium text-gray-700">{{ $post->user->name }}</div>
                                <a href="{{ route('posts.show', $post) }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">Read</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $posts->onEachSide(1)->links('pagination.custom') }}
            </div>
        @else
            <div class="max-w-md mx-auto text-center py-16">
                <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-3">No posts found</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('search') || request('category'))
                        Try different search terms or
                        <a href="{{ route('posts.index') }}" class="text-blue-600 font-medium hover:underline">clear filters</a>
                    @else
                        Be the first to share your thoughts
                    @endif
                </p>
                @auth
                    <a href="{{ route('posts.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                        Create Post
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                        Join Community
                    </a>
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection

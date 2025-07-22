@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    <a href="{{ route('posts.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Blog</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-900 truncate">{{ Str::limit($post->title, 30) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="p-8">
            @if($post->status === 'draft')
                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Draft - Only visible to you
                    </span>
                </div>
            @endif

            @if($post->categories->count() > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($post->categories as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="inline-block px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition duration-150 ease-in-out">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-6 mb-8">
                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-lg">
                                {{ substr($post->user->name, 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                            <p class="text-sm text-gray-500">Author</p>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center space-x-1 text-sm text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Published {{ $post->created_at->format('F j, Y') }}</span>
                        </div>

                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min read</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->check() && auth()->id() === $post->user_id)
                    <div class="flex space-x-3">
                        <a href="{{ route('posts.edit', ['post' => $post->slug]) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('posts.remove', ['post' => $post->slug]) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition duration-150 ease-in-out">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-blue-600 prose-strong:text-gray-900">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Share this post:</span>
                        <div class="flex space-x-2">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 text-sm text-gray-500 hover:text-blue-500 transition duration-150 ease-in-out">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 text-sm text-gray-500 hover:text-blue-600 transition duration-150 ease-in-out">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    @if($post->updated_at->ne($post->created_at))
                        <div class="text-sm text-gray-500">
                            Last updated {{ $post->updated_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>

    @if($post->categories->count() > 0)
        @php
            $relatedPosts = \App\Models\Post::with(['user', 'categories'])
                ->published()
                ->where('id', '!=', $post->id)
                ->whereHas('categories', function($query) use ($post) {
                    $query->whereIn('categories.id', $post->categories->pluck('id'));
                })
                ->latest()
                ->take(3)
                ->get();
        @endphp

        @if($relatedPosts->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Related Posts</h3>
                <div class="grid grid-cols-1 md:grid-cols-{{ $relatedPosts->count() === 1 ? '1' : ($relatedPosts->count() === 2 ? '2' : '3') }} gap-6">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 ease-in-out">
                            <div class="p-6">
                                @if($relatedPost->categories->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($relatedPost->categories->take(2) as $category)
                                            <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('posts.show', $relatedPost) }}"
                                       class="hover:text-blue-600 transition duration-150 ease-in-out">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h4>

                                <p class="text-gray-600 text-sm mb-3">
                                    {{ Str::limit(strip_tags($relatedPost->body), 100) }}
                                </p>

                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $relatedPost->user->name }}</span>
                                    <span>{{ $relatedPost->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    <div class="mt-12">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                Comments ({{ $post->comments->count() }})
            </h3>

            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                            Add your comment
                        </label>
                        <textarea name="body"
                                  id="body"
                                  rows="4"
                                  placeholder="Share your thoughts about this post..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Post Comment
                    </button>
                </form>
            @else
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <p class="text-gray-600 text-center">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">Login</a>
                        or
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">register</a>
                        to join the conversation.
                    </p>
                </div>
            @endauth

            @if($post->comments->count() > 0)
                <div class="space-y-6">
                    @foreach($post->comments as $comment)
                        <div class="border-l-4 border-gray-200 pl-6 hover:border-blue-300 transition duration-150 ease-in-out">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-10 bg-gray-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                            @if($comment->created_at->ne($comment->updated_at))
                                                • edited
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if(auth()->check() && auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 text-sm p-1 rounded hover:bg-red-50 transition duration-150 ease-in-out">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="text-gray-700 leading-relaxed">
                                {{ $comment->body }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h4 class="mt-4 text-lg font-medium text-gray-900">No comments yet</h4>
                    <p class="mt-2 text-gray-500">Be the first to share your thoughts about this post!</p>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8 flex items-center justify-between">
        <a href="{{ route('posts.index') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-500 font-medium">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to all posts
        </a>

        @auth
            @if(auth()->id() === $post->user_id)
                <a href="{{ route('posts.my-posts') }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-500 font-medium">
                    View my posts
                    <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        @endauth
    </div>
</div>
@endsection

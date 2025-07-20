@extends('layouts.app')

@section('title', '- Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="mt-2 text-gray-600">Here's what's happening with your blog</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Posts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_posts'] }}</p>
                </div>
            </div>
        </div>

        <!-- Published Posts -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Published</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['published_posts'] }}</p>
                </div>
            </div>
        </div>

        <!-- Draft Posts -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Drafts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['draft_posts'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Comments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_comments'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('posts.create') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Write New Post
            </a>

            <a href="{{ route('posts.my-posts') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                View All Posts
            </a>

            <a href="{{ route('posts.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Browse Blog
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Posts -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Posts</h3>
                    <a href="{{ route('posts.my-posts') }}"
                       class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                        View all
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($recent_posts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_posts as $post)
                            <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50">
                                <div class="flex-shrink-0">
                                    @if($post->status === 'published')
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    @else
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">
                                            <a href="{{ route('posts.show', $post) }}"
                                               class="hover:text-blue-600">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span>{{ $post->created_at->format('M j, Y') }}</span>
                                        @if($post->categories->count() > 0)
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->categories->pluck('name')->implode(', ') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h4 class="mt-2 text-sm font-medium text-gray-900">No posts yet</h4>
                        <p class="mt-1 text-sm text-gray-500">Get started by writing your first post.</p>
                        <div class="mt-4">
                            <a href="{{ route('posts.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                                Write Post
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Comments -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Comments</h3>
            </div>

            <div class="p-6">
                @if($recent_comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_comments as $comment)
                            <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-700 mb-1">{{ Str::limit($comment->body, 60) }}</p>
                                    <p class="text-xs text-gray-500">
                                        On: <a href="{{ route('posts.show', $comment->post) }}"
                                               class="text-blue-600 hover:text-blue-500">{{ $comment->post->title }}</a>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h4 class="mt-2 text-sm font-medium text-gray-900">No comments yet</h4>
                        <p class="mt-1 text-sm text-gray-500">Your comments on posts will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Activity Summary -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Keep Writing!</h3>
                <p class="text-gray-600 mt-1">
                    @if($stats['published_posts'] === 0)
                        You haven't published any posts yet. Start sharing your ideas with the world!
                    @elseif($stats['published_posts'] < 5)
                        You're off to a great start with {{ $stats['published_posts'] }} published {{ Str::plural('post', $stats['published_posts']) }}!
                    @else
                        Amazing! You've published {{ $stats['published_posts'] }} posts. Keep the momentum going!
                    @endif
                </p>
            </div>
            <div class="flex space-x-3">
                @if($stats['draft_posts'] > 0)
                    <a href="{{ route('posts.my-posts') }}?status=draft"
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Finish {{ $stats['draft_posts'] }} {{ Str::plural('Draft', $stats['draft_posts']) }}
                    </a>
                @endif
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Post
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

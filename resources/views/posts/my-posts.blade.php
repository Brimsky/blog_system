@extends('layouts.app')

@section('title', '- My Posts')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Blog Posts</h1>
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition duration-150 ease-in-out">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $post->created_at->format('M j, Y') }}</span>
                            <span>{{ $post->comments->count() }} comments</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="flex justify-center">
            {{ $posts->links('pagination.custom') }}
        </div>
    @else
        <div class="text-center py-16">
            <h3 class="mt-4 text-lg font-medium text-gray-900">You haven't written any posts yet.</h3>
            <a href="{{ route('posts.create') }}" class="text-blue-600 hover:text-blue-500 font-medium">Create your first post</a>
        </div>
    @endif
</div>
@endsection

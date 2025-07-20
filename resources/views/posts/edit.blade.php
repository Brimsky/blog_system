@extends('layouts.app')

@section('title', "- Edit {$post->title}")

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('posts.show', $post) }}"
               class="text-blue-600 hover:text-blue-500 font-medium">
                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Post
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Post</h1>
        <p class="mt-2 text-gray-600">Make changes to your blog post</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <form action="{{ route('posts.update', $post) }}" method="POST" class="p-8">
            @csrf
            @method('PATCH')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Post Title <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $post->title) }}"
                       placeholder="Enter a compelling title for your post..."
                       maxlength="255"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Maximum 255 characters</p>
            </div>

            <!-- Body -->
            <div class="mb-6">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                    Post Content <span class="text-red-500">*</span>
                </label>
                <textarea name="body"
                          id="body"
                          rows="12"
                          placeholder="Write your post content here. You can use basic HTML tags like <p>, <strong>, <em>, etc."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Minimum 10 characters. Basic HTML tags are allowed.</p>
            </div>

            <!-- Categories -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Categories
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($categories as $category)
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox"
                                   name="categories[]"
                                   value="{{ $category->id }}"
                                   {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-3 text-sm text-gray-700">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-2">Select one or more categories that best describe your post</p>
            </div>

            <!-- Status -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Publication Status <span class="text-red-500">*</span>
                </label>
                <div class="space-y-3">
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="radio"
                               name="status"
                               value="draft"
                               {{ old('status', $post->status) === 'draft' ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-700">Save as Draft</span>
                            <p class="text-xs text-gray-500">Only you can see this post. You can publish it later.</p>
                        </div>
                    </label>
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="radio"
                               name="status"
                               value="published"
                               {{ old('status', $post->status) === 'published' ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-700">
                                @if($post->status === 'published')
                                    Keep Published
                                @else
                                    Publish Now
                                @endif
                            </span>
                            <p class="text-xs text-gray-500">
                                @if($post->status === 'published')
                                    This post will remain visible to everyone.
                                @else
                                    Make this post visible to everyone immediately.
                                @endif
                            </p>
                        </div>
                    </label>
                </div>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-150 ease-in-out">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Post
                </button>

                <a href="{{ route('posts.show', $post) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 focus:ring-4 focus:ring-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>

                <!-- Delete Post -->
                <div class="sm:ml-auto">
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone and will also delete all comments.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200 transition duration-150 ease-in-out">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>

    <!-- Post Information -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h3 class="text-lg font-medium text-blue-900 mb-3">Post Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
            <div>
                <span class="font-medium">Created:</span> {{ $post->created_at->format('F j, Y \a\t g:i A') }}
            </div>
            <div>
                <span class="font-medium">Last Updated:</span> {{ $post->updated_at->format('F j, Y \a\t g:i A') }}
            </div>
            <div>
                <span class="font-medium">Current Status:</span>
                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            <div>
                <span class="font-medium">Comments:</span> {{ $post->comments->count() }}
                {{ Str::plural('comment', $post->comments->count()) }}
            </div>
        </div>
    </div>

    <!-- Editing Tips -->
    <div class="mt-8 bg-amber-50 rounded-lg p-6">
        <h3 class="text-lg font-medium text-amber-900 mb-3">Editing Tips</h3>
        <ul class="space-y-2 text-sm text-amber-800">
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Save as draft if you're not ready to publish your changes
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Changing the title will update the post URL (slug)
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Deleting this post will also remove all associated comments
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Use categories to help readers discover your content
            </li>
        </ul>
    </div>
</div>

<script>
    // Character counter for title
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const maxLength = 255;

        if (titleInput) {
            titleInput.addEventListener('input', function() {
                const remaining = maxLength - this.value.length;
                const counter = document.querySelector('#title + .text-red-600 + .text-gray-500') ||
                               document.querySelector('#title + .text-gray-500');

                if (counter) {
                    counter.textContent = `${remaining} characters remaining`;
                    if (remaining < 50) {
                        counter.classList.add('text-orange-500');
                        counter.classList.remove('text-gray-500');
                    } else {
                        counter.classList.add('text-gray-500');
                        counter.classList.remove('text-orange-500');
                    }
                }
            });
        }
    });
</script>
@endsection

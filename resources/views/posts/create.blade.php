@extends('layouts.app')

@section('title', '- Create New Post')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create New Post</h1>
        <p class="mt-2 text-gray-600">Share your thoughts and insights with the community</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200">
        <form action="{{ route('posts.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Post Title <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title') }}"
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
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
                                   {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
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
                               {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}
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
                               {{ old('status') === 'published' ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-700">Publish Now</span>
                            <p class="text-xs text-gray-500">Make this post visible to everyone immediately.</p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Create Post
                </button>

                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 focus:ring-4 focus:ring-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Writing Tips -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h3 class="text-lg font-medium text-blue-900 mb-3">Writing Tips</h3>
        <ul class="space-y-2 text-sm text-blue-800">
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Choose a clear, descriptive title that captures the essence of your post
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Structure your content with clear paragraphs and logical flow
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Select relevant categories to help readers discover your content
            </li>
            <li class="flex items-start">
                <svg class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Use "Save as Draft" to continue working on your post later
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

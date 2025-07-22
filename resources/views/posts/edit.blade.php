@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6 bg-gray-50 min-h-screen">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('posts.show', $post) }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-500 font-medium transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Post
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Post</h1>
            <p class="text-gray-600">Make changes to your blog post</p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" id="toggle-preview"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-full hover:bg-gray-50 transition-colors">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span id="preview-text">Show Preview</span>
            </button>
        </div>
    </div>

    <div id="main-container" class="grid gap-6 lg:grid-cols-3">
        <div id="form-section" class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-xl font-semibold flex items-center gap-2 text-gray-900">
                        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Post Details
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                   placeholder="Enter post title..." required maxlength="255"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs">Maximum 255 characters</p>
                        </div>

                        <div class="space-y-2">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $post->excerpt) }}"
                                   placeholder="Brief description of the post..."
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            @error('excerpt')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="space-y-2">
                        <label for="body" class="block text-sm font-medium text-gray-700">Content *</label>

                        <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg border border-gray-200">
                            <button type="button" onclick="formatText('bold')" title="Bold"
                                    class="p-2 text-gray-600 hover:text-gray-900 hover:bg-white rounded transition-colors">
                                <strong>B</strong>
                            </button>
                            <button type="button" onclick="formatText('italic')" title="Italic"
                                    class="p-2 text-gray-600 hover:text-gray-900 hover:bg-white rounded transition-colors">
                                <em>I</em>
                            </button>
                            <button type="button" onclick="formatText('quote')" title="Quote"
                                    class="p-2 text-gray-600 hover:text-gray-900 hover:bg-white rounded transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </button>
                            <button type="button" onclick="formatText('list')" title="List"
                                    class="p-2 text-gray-600 hover:text-gray-900 hover:bg-white rounded transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>

                        <textarea name="body" id="body" rows="12" required
                                  placeholder="Edit your post content here... Use **bold**, *italic*, > quotes, - lists"
                                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm resize-vertical">{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs">Minimum 10 characters. Basic HTML tags are allowed.</p>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <form method="POST" action="{{ route('posts.save-draft', $post->slug) }}" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="title" id="draft-title">
                            <input type="hidden" name="excerpt" id="draft-excerpt">
                            <input type="hidden" name="body" id="draft-body">
                            <input type="hidden" name="category_id" id="draft-category">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-full hover:bg-gray-50 transition-colors">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Save as Draft
                            </button>
                        </form>

                        <form method="POST" action="{{ route('posts.publish', $post->slug) }}" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="title" id="publish-title">
                            <input type="hidden" name="excerpt" id="publish-excerpt">
                            <input type="hidden" name="body" id="publish-body">
                            <input type="hidden" name="category_id" id="publish-category">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-medium rounded-full transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $post->status === 'published' ? 'Update Post' : 'Publish Post' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="sidebar" class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Category & Tags</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                        <select name="category_id" id="category_id" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Publishing</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Current Status</label>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 rounded-xl border border-blue-200">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-blue-900 mb-3">Post Information</h3>
                    <div class="space-y-2 text-sm text-blue-800">
                        <div>
                            <span class="font-medium">Created:</span> {{ $post->created_at->format('M j, Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Last Updated:</span> {{ $post->updated_at->format('M j, Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Comments:</span> {{ $post->comments->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-red-50 rounded-xl border border-red-200">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-red-900 mb-3">Danger Zone</h3>
                    <p class="text-sm text-red-700 mb-4">Once you delete a post, there is no going back. This will also delete all comments.</p>
                    <form action="{{ route('posts.remove', $post->slug) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone and will also delete all comments.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="preview-section" class="lg:col-span-1 hidden">
            <div class="sticky top-6">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Preview</h2>
                    <p class="text-gray-600">How your post will look</p>
                </div>
                <div id="preview-content" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="space-y-4">
                        <div id="preview-category" class="hidden">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800"></span>
                        </div>
                        <h3 id="preview-title" class="text-xl font-bold text-gray-900">Your post title will appear here</h3>
                        <div id="preview-meta" class="flex items-center gap-4 text-sm text-gray-500">
                            <span id="preview-author">{{ $post->user->name }}</span>
                            <span>{{ $post->updated_at->format('M j, Y') }}</span>
                        </div>
                        <div id="preview-body" class="text-gray-600">Your post content will appear here...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let showPreview = false;

    const titleInput = document.getElementById('title');
    const excerptInput = document.getElementById('excerpt');
    const bodyTextarea = document.getElementById('body');
    const categorySelect = document.getElementById('category_id');

    const togglePreviewBtn = document.getElementById('toggle-preview');
    const previewText = document.getElementById('preview-text');
    const mainContainer = document.getElementById('main-container');
    const formSection = document.getElementById('form-section');
    const sidebar = document.getElementById('sidebar');
    const previewSection = document.getElementById('preview-section');
    const previewTitle = document.getElementById('preview-title');
    const previewBody = document.getElementById('preview-body');
    const previewCategory = document.getElementById('preview-category');

    function syncFormData() {
        const title = titleInput.value;
        const excerpt = excerptInput.value;
        const body = bodyTextarea.value;
        const category = categorySelect.value;

        document.getElementById('draft-title').value = title;
        document.getElementById('draft-excerpt').value = excerpt;
        document.getElementById('draft-body').value = body;
        document.getElementById('draft-category').value = category;

        document.getElementById('publish-title').value = title;
        document.getElementById('publish-excerpt').value = excerpt;
        document.getElementById('publish-body').value = body;
        document.getElementById('publish-category').value = category;
    }

    [titleInput, excerptInput, bodyTextarea, categorySelect].forEach(function(element) {
        element.addEventListener('input', syncFormData);
        element.addEventListener('change', syncFormData);
    });

    syncFormData();

    function togglePreview() {
        showPreview = !showPreview;

        if (showPreview) {
            mainContainer.className = 'grid gap-6 lg:grid-cols-2';
            formSection.className = 'lg:col-span-1';
            sidebar.classList.add('hidden');
            previewSection.classList.remove('hidden');
            previewText.textContent = 'Hide Preview';
            updatePreview();
        } else {
            mainContainer.className = 'grid gap-6 lg:grid-cols-3';
            formSection.className = 'lg:col-span-2';
            sidebar.classList.remove('hidden');
            previewSection.classList.add('hidden');
            previewText.textContent = 'Show Preview';
        }
    }

    function updatePreview() {
        if (!showPreview) return;

        const title = titleInput.value.trim();
        previewTitle.textContent = title || 'Your post title will appear here';

        let body = bodyTextarea.value.trim();
        if (body) {
            body = body
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/^> (.+)/gm, '<blockquote class="border-l-4 border-blue-500 pl-4 italic">$1</blockquote>')
                .replace(/^- (.+)/gm, '<li>$1</li>')
                .replace(/(\n<li>.*<\/li>\n)/gs, '<ul class="list-disc pl-5">$1</ul>')
                .replace(/\n/g, '<br>');

            previewBody.innerHTML = body;
        } else {
            previewBody.textContent = 'Your post content will appear here...';
        }

        const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
        if (selectedCategory && selectedCategory.value) {
            previewCategory.classList.remove('hidden');
            previewCategory.querySelector('span').textContent = selectedCategory.text;
        } else {
            previewCategory.classList.add('hidden');
        }
    }

    window.formatText = function(type) {
        const textarea = bodyTextarea;
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        let replacement = '';

        switch (type) {
            case 'bold':
                replacement = `**${selectedText || 'bold text'}**`;
                break;
            case 'italic':
                replacement = `*${selectedText || 'italic text'}*`;
                break;
            case 'quote':
                replacement = `> ${selectedText || 'quoted text'}`;
                break;
            case 'list':
                replacement = `- ${selectedText || 'list item'}`;
                break;
        }

        textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
        textarea.focus();

        const newPos = start + replacement.length;
        textarea.setSelectionRange(newPos, newPos);

        updatePreview();
        syncFormData();
    };

    togglePreviewBtn.addEventListener('click', togglePreview);

    [titleInput, excerptInput, bodyTextarea, categorySelect].forEach(function(element) {
        element.addEventListener('input', updatePreview);
        element.addEventListener('change', updatePreview);
    });

    updatePreview();
});
</script>

<style>
    .bg-gradient-to-r {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
    }

    .hover\:from-blue-600:hover {
        background: linear-gradient(to right, #2563eb, #7c3aed);
    }

    * {
        transition: all 0.2s ease-in-out;
    }

    textarea {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f7fafc;
    }

    textarea::-webkit-scrollbar {
        width: 6px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f7fafc;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            alert('{{ session("success") }}');
        }, 100);
    });
</script>
@endif
@endsection

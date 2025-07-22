@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6 bg-gray-50 min-h-screen">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create New Post</h1>
            <p class="text-gray-600">Write and publish your blog post</p>
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

    <form method="POST" action="{{ route('posts.store') }}" id="blog-form" class="space-y-0">
        @csrf

        <div id="main-container" class="grid gap-6 lg:grid-cols-3">
            <div id="form-section" class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-xl font-semibold flex items-center gap-2 text-gray-900">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Post Details
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                       placeholder="Enter post title..." required
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                @error('title')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}"
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
                                      placeholder="Start writing your post content here... Use **bold**, *italic*, > quotes, - lists"
                                      class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm resize-vertical">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="status" id="status-hidden" value="{{ old('status', 'draft') }}">
                        <div class="flex gap-3 pt-4 border-t border-gray-200">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-full hover:bg-gray-50 transition-colors" onclick="document.getElementById('status-hidden').value='draft'">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Save Draft
                            </button>
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-medium rounded-full transition-all duration-200 shadow-lg hover:shadow-xl" onclick="document.getElementById('status-hidden').value='published'">
                                Publish Post
                            </button>
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
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Draft (default)
                                </span>
                            </div>
                        </div>
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
                                <span id="preview-author">Anonymous</span>
                                <span>{{ date('M j, Y') }}</span>
                            </div>
                            <div id="preview-body" class="text-gray-600">Your post content will appear here...</div>
                            <div id="preview-tags" class="flex flex-wrap gap-2 hidden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedTags = @json(old('tags', []));
    let showPreview = false;

    const form = document.getElementById('blog-form');
    const titleInput = document.getElementById('title');
    const authorInput = document.getElementById('author');
    const bodyTextarea = document.getElementById('body');
    const categorySelect = document.getElementById('category_id');
    const tagInput = document.getElementById('tag-input');
    const addTagBtn = document.getElementById('add-tag-btn');
    const selectedTagsContainer = document.getElementById('selected-tags');
    const popularTags = document.querySelectorAll('.popular-tag');

    const togglePreviewBtn = document.getElementById('toggle-preview');
    const previewText = document.getElementById('preview-text');
    const mainContainer = document.getElementById('main-container');
    const formSection = document.getElementById('form-section');
    const sidebar = document.getElementById('sidebar');
    const previewSection = document.getElementById('preview-section');
    const previewTitle = document.getElementById('preview-title');
    const previewAuthor = document.getElementById('preview-author');
    const previewBody = document.getElementById('preview-body');
    const previewCategory = document.getElementById('preview-category');
    const previewTags = document.getElementById('preview-tags');

    function addTag(tagName) {
        const trimmedTag = tagName.trim().toLowerCase();
        if (trimmedTag && !selectedTags.includes(trimmedTag) && selectedTags.length < 5) {
            selectedTags.push(trimmedTag);
            updateTagsDisplay();
            updatePreview();
        }
        tagInput.value = '';
    }

    function removeTag(tagToRemove) {
        selectedTags = selectedTags.filter(tag => tag !== tagToRemove);
        updateTagsDisplay();
        updatePreview();
    }

    function updateTagsDisplay() {
        if (selectedTags.length > 0) {
            selectedTagsContainer.classList.remove('hidden');
            selectedTagsContainer.innerHTML = selectedTags.map(tag => `
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    ${tag}
                    <button type="button" onclick="removeTag('${tag}')" class="ml-1 text-blue-600 hover:text-red-500">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
            `).join('');
        } else {
            selectedTagsContainer.classList.add('hidden');
        }
    }

    window.removeTag = removeTag;

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

        const author = authorInput.value.trim();
        previewAuthor.textContent = author || 'Anonymous';

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

        if (selectedTags.length > 0) {
            previewTags.classList.remove('hidden');
            previewTags.innerHTML = selectedTags.map(tag => `
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    #${tag}
                </span>
            `).join('');
        } else {
            previewTags.classList.add('hidden');
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
    };

    togglePreviewBtn.addEventListener('click', togglePreview);

    addTagBtn.addEventListener('click', function() {
        addTag(tagInput.value);
    });

    tagInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(this.value);
        }
    });

    popularTags.forEach(function(tagElement) {
        tagElement.addEventListener('click', function() {
            addTag(this.dataset.tag);
        });
    });

    [titleInput, authorInput, bodyTextarea, categorySelect].forEach(function(element) {
        element.addEventListener('input', updatePreview);
        element.addEventListener('change', updatePreview);
    });

    form.addEventListener('submit', function(e) {
        const existingTagInputs = form.querySelectorAll('input[name^="tags["]');
        existingTagInputs.forEach(input => input.remove());

        selectedTags.forEach(function(tag, index) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `tags[${index}]`;
            hiddenInput.value = tag;
            form.appendChild(hiddenInput);
        });
    });

    @if(old('tags'))
        selectedTags = @json(array_values(old('tags')));
        updateTagsDisplay();
        updatePreview();
    @endif
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

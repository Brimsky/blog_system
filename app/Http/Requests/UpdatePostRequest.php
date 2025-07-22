<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post = $this->route('post');
        return auth()->check() && auth()->id() === $post->user_id;
    }

    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'min:3',
                Rule::unique('posts', 'title')->ignore($post->id)
            ],
            'body' => 'required|string|min:10',
            'excerpt' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Post title is required.',
            'title.unique' => 'A post with this title already exists.',
            'title.min' => 'Post title must be at least 3 characters.',
            'title.max' => 'Post title cannot exceed 255 characters.',
            'body.required' => 'Post content is required.',
            'body.min' => 'Post content must be at least 10 characters.',
            'excerpt.max' => 'Excerpt cannot exceed 255 characters.',
            'status.required' => 'Post status is required.',
            'status.in' => 'Post status must be either draft or published.',
            'category_id.required' => 'Category is required.',
            'category_id.integer' => 'Category must be a valid selection.',
            'category_id.exists' => 'Selected category does not exist.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('body')) {
            $this->merge([
                'body' => strip_tags($this->body, '<p><br><strong><em><ul><ol><li><h1><h2><h3><h4><h5><h6>')
            ]);
        }

        if ($this->has('title')) {
            $this->merge([
                'title' => trim($this->title)
            ]);
        }
    }
}

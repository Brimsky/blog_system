<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:3',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'body' => 'required|string|min:3|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'body.required' => 'Comment content is required.',
            'body.min' => 'Comment must be at least 3 characters.',
            'body.max' => 'Comment cannot exceed 1000 characters.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('body')) {
            $this->merge([
                'body' => strip_tags(trim($this->body))
            ]);
        }
    }
}

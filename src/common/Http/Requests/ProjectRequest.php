<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'long_description1' => 'nullable|string',
            'long_description2' => 'nullable|string',
            'long_description3' => 'nullable|string',
            'highlighted_text1' => 'nullable|string',
            'highlighted_text2' => 'nullable|string',
            'ad_url' => 'nullable|string|max:255',
            'views' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_img' => 'nullable|image',
        ];
    }
}

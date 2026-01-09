<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Update this as needed for authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'app_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:20',
        ];

        if ($this->hasFile('favicon')) {
            $rules['favicon'] = 'image|mimes:png,svg|max:2048';
        }
        if ($this->hasFile('dark_logo')) {
            $rules['dark_logo'] = 'image|mimes:png,svg|max:2048';
        }
        if ($this->hasFile('light_logo')) {
            $rules['light_logo'] = 'image|mimes:png,svg|max:2048';
        }

        return $rules;
    }
}
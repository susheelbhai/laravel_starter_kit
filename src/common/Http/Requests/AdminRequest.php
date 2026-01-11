<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the id from the route if present (for update), otherwise null (for store)
        $id = $this->route('admin');
        $rules = [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:admins,email' . ($id ? (',' . $id) : ''),
            'phone'  => 'required|unique:admins,phone' . ($id ? (',' . $id) : ''),
            'dob'    => 'nullable|date',
            'address' => 'nullable|string',
            'city'   => 'nullable|string',
            'state'  => 'nullable|string',
            'roles'       => 'nullable|array',
            'permissions' => 'nullable|array',
        ];
        if($this->hasFile('profile_pic')) {
            $rules['profile_pic'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        return $rules;
    }
}

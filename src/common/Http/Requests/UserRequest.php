<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('user') ?? $this->route('id');
        $uniquePhone = 'unique:users,phone';
        $uniqueEmail = 'unique:users,email';
        if ($id) {
            $uniquePhone .= ",{$id}";
            $uniqueEmail .= ",{$id}";
        }
        $rules = [
            'name' => 'required',
            'phone' => ['required', $uniquePhone],
            'email' => ['required', 'email', $uniqueEmail],
        ];
        if ($this->hasFile('profile_pic')) {
            $rules['profile_pic'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        return $rules;
    }
}

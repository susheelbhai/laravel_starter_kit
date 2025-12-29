<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('seller') ?? $this->route('id');
        $uniquePhone = 'unique:partners,phone';
        $uniqueEmail = 'unique:partners,email';
        if ($id) {
            $uniquePhone .= ",{$id}";
            $uniqueEmail .= ",{$id}";
        }
        return [
            'name' => 'required',
            'phone' => ['required', $uniquePhone],
            'email' => ['required', 'email', $uniqueEmail],
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

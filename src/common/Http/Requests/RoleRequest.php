<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('role') ?? $this->route('id');
        $uniqueName = 'unique:roles,name';
        if ($id) {
            $uniqueName .= ",{$id}";
        }
        return [
            'name' => ['required', $uniqueName],
            'permissions' => 'required|array',
        ];
    }
}

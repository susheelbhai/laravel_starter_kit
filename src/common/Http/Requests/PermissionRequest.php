<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('permission') ?? $this->route('id');
        $uniqueName = 'unique:permissions,name';
        if ($id) {
            $uniqueName .= ",{$id}";
        }
        return [
            'name' => ['required', $uniqueName],
            'roles' => 'required|array',
        ];
    }
}

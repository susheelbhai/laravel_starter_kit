<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ];
    }
}

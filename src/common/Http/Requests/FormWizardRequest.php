<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormWizardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $field = $this->input('field');
        $rulesByField = [

            // --------------------------------------------------
            // 1️⃣ Basic Details
            // --------------------------------------------------
            'basic_details' => [
                'name'          => 'required|string|max:255',
                'email'        => 'required|email',
                'phone' => 'required|string|max:20',
                'address1' => 'required|string|max:255',
                'address2' => 'nullable|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'pin_code' => 'required|string|max:20',
                'country' => 'required|string|max:100',

            ],

            // --------------------------------------------------
            // 2️⃣ bank_detail
            // --------------------------------------------------
            'bank_detail' => [
                'bank_account_holder_name' => 'required|string|max:255',
                'bank_account_number'      => 'required|string|max:50',
                'bank_ifsc'           => 'required|string|max:20',
                'bank_upi_id'          => 'nullable|string|max:255',
            ],

            // --------------------------------------------------
            // 3️⃣ Education
            // --------------------------------------------------
            'education' => [],


            // --------------------------------------------------
            // 8️⃣ Other Info
            // --------------------------------------------------
            'other_info' => [
                'short_description' => 'nullable|string|max:255',
                'biodata' => 'nullable|string',
            ],

        ];

        return $rulesByField[$field] ?? [];
    }


    public function messages(): array
    {

        return array_merge([
            'required' => 'This field is required.',
        ],);
    }
}

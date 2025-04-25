<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGlobalEmailTemplateRequest extends FormRequest
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
        return [
            'header' => [
                'nullable',
                'string',
            ],
            'default_header' => ['nullable',
                'in:0,1',
            ],
            'footer' => [
                'nullable',
                'string',
            ],
            'default_footer' => ['nullable',
                'in:0,1',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmailTemplateRequest extends FormRequest
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
            'footer' => [
                'nullable',
                'string',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                // 'unique:email_templates,name',
                // if request method is put, then check for unique name
                Rule::unique('email_templates', 'name')->ignore($this->email_template),
            ],
            'subject' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'body' => [
                'required',
                'string',
            ],
            'placeholders' => [
                'nullable',
                'string',
            ],
        ];
    }
}

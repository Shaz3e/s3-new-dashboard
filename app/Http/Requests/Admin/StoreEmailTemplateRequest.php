<?php

namespace App\Http\Requests\Admin;

use App\Rules\ImageRule;
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
            'header_image' => [
                'nullable',
                new ImageRule,
            ],
            'header_text' => ['nullable', 'string'],
            'header_text_color' => ['nullable', 'string'],
            'header_background_color' => ['nullable', 'string'],

            'footer_image' => [
                'nullable',
                new ImageRule,
            ],
            'footer_text' => ['nullable', 'string'],
            'footer_text_color' => ['nullable', 'string'],
            'footer_background_color' => ['nullable', 'string'],
            'footer_bottom_image' => [
                'nullable',
                new ImageRule,
            ],
            'key' => [
                'required',
                'string',
                'max:255',
                Rule::unique('email_templates', 'key')->ignore($this->email_template),
            ],
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['required', 'string'],
            'placeholders' => ['nullable', 'string'],
        ];
    }
}

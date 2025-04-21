<?php

namespace App\Http\Requests\Admin;

use App\Rules\FirstNameRule;
use App\Rules\LastNameRule;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
            'first_name' => [
                'required',
                new FirstNameRule,
            ],
            'last_name' => [
                'required',
                new LastNameRule,
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->client),
            ],
            'password' => [
                $this->isMethod('put') ? 'nullable' : 'required',
                new PasswordRule,
            ],
            'is_active' => [
                $this->isMethod('put') ? 'nullable' : 'required',
                'boolean',
            ],
            'email_verified_at' => [
                $this->isMethod('put') ? 'nullable' : 'required',
                'boolean',
            ],
        ];
    }
}

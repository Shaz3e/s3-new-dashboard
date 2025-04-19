<?php

namespace App\Http\Requests;

use App\Rules\FirstNameRule;
use App\Rules\LastNameRule;
use App\Rules\PasswordRule;
use App\Rules\UniqueEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
                new UniqueEmailRule,
            ],
            'password' => [
                new PasswordRule,
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
            'email_verified_at' => [
                'required',
                'boolean',
            ],
        ];
    }
}

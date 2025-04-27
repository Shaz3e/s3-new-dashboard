<?php

namespace App\Http\Requests\Auth;

use App\Rules\FirstNameRule;
use App\Rules\LastNameRule;
use App\Rules\PasswordRule;
use App\Rules\UniqueEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'agree_terms' => $this->has('agree_terms') ? 1 : 0,
        ]);
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
            'password_confirmation' => [
                'required',
                'same:password',
            ],
            'agree_terms' => [
                'accepted',
            ],
        ];
    }
}

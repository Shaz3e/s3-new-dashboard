<?php

namespace App\Http\Requests\Profile;

use App\Models\Profile;
use App\Rules\FirstNameRule;
use App\Rules\LastNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfileRequest extends FormRequest
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
            'username' => [
                'required',
                'max:65',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'dob' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                Rule::in(Profile::getGenderTypes()),
            ],
            'phone' => [
                'required',
                'max:100',
            ],
            'city' => [
                'required',
                'max:255',
            ],
            'state' => [
                'required',
                'max:255',
            ],
            'country' => [
                'required',
                'max:255',
            ],
            'zipcode' => [
                'required',
                'max:20',
            ],
            'address' => [
                'required',
                'max:255',
            ],
        ];
    }
}

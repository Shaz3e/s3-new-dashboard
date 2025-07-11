<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
            'name' => [
                $this->isMethod('put') && ! $this->has('syncPermissions') ? 'required' : 'nullable',
                'string',
                'min:3',
                'max:150',
                Rule::unique('roles', 'name')->ignore($this->role),
            ],
            'permissions' => [
                'array',
            ],
        ];
    }
}

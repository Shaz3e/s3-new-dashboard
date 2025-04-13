<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // email address should not be empty
        if (empty($value)) {
            $fail('Email address is required');

            return;
        }

        // email address max length is 255
        if (strlen($value) > 255) {
            $fail('Email address is too long');

            return;
        }

        // Should be valid email
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail('Email address is not valid');

            return;
        }
        // email address should be unique
        if (User::where('email', $value)->exists()) {
            $fail('Email address already exists');

            return;
        }
    }
}

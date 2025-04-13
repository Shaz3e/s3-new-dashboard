<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FirstNameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // First name should not have number
        if (preg_match('/[0-9]/', $value)) {
            $fail('First name should not have number');

            return;
        }

        // First name should not have special characters
        if (preg_match('/[^a-zA-Z0-9\s]/', $value)) {
            $fail('First name should not have special characters');

            return;
        }

        // First name should not start with number or special character
        if (preg_match('/^[^a-zA-Z0-9]/', $value)) {
            $fail('First name should not start with number or special character');

            return;
        }

        // First name should have max 70 characters
        if (strlen($value) > 70) {
            $fail('First name should have max 70 characters');

            return;
        }
    }
}

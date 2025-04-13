<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if value is required
        if (empty($value)) {
            $fail("The {$attribute} field is required.");

            return;
        }

        // Check minimum length
        if (strlen($value) < 8) {
            $fail('Password must be at least 8 characters.');

            return;
        }

        // Check maximum length
        if (strlen($value) > 65) {
            $fail('Password must be less than 65 characters.');

            return;
        }

        // Check regex pattern
        // if (! preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/', $value)) {
        //     $fail('Please choose a password that includes at least 1 uppercase character, 1 lowercase character, and 1 number and 1 special character.');

        //     return;
        // }
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterNowTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Convert the current time to H:i format
        $currentTime = now()->format('H:i');

        // Check if the given time is after the current time
        if ($value <= $currentTime) {
            $fail("The $attribute must be a time after the current time.");
        }
    }
}

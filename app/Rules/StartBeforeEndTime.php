<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StartBeforeEndTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startTime = Carbon::createFromFormat('H:i', request('start_time'));
        $endTime = Carbon::createFromFormat('H:i', $value);

        if (!$startTime->lessThan($endTime)) {
            $fail('The end time must be greater than the start time.');
        }
    }
}

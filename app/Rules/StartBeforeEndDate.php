<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StartBeforeEndDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = Carbon::createFromFormat('d.m.Y', request('start_date'));
        $endDate = Carbon::createFromFormat('d.m.Y', $value);

        if (!$startDate->lessThanOrEqualTo($endDate)) {
            $fail('The end date must be greater than or equal to the start date.');
        }
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;
use Illuminate\Translation\PotentiallyTranslatedString;

class EitherGoalOrHabit implements ValidationRule
{


    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $data = Request::all();
        $goalId = $data['goal_id'] ?? null;
        $habitId = $data['habit_id'] ?? null;

        if ($goalId && $habitId) {
            $fail('Either goal_id or habit_id must be present, but not both.');
        }

        if (!$goalId && !$habitId) {
            $fail('Either goal_id or habit_id must be present.');
        }
    }
}

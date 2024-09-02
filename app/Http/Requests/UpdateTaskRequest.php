<?php

namespace App\Http\Requests;

use App\Enums\RepeatTypes;
use App\Rules\EitherGoalOrHabit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'block_id' => ['id', 'exists:blocks,id'],
            'goal_id' => ['integer', 'exists:goals,id', new EitherGoalOrHabit],
            'habit_id' => ['integer', 'exists:habits,id', new EitherGoalOrHabit],
            'title' => ['string', 'max:255'],
            'details' => ['string'],
            'urgent' => ['urgent'],
            'start_date' => ['date', 'after_or_equal:today'],
        ];
    }
}

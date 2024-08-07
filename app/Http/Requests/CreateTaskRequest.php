<?php

namespace App\Http\Requests;

use App\Enums\RepeatTypes;
use App\Rules\EitherGoalOrHabit;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'block_id' => ['integer', 'exists:blocks,id'],
            'goal_id' => ['integer', 'exists:goals,id', new EitherGoalOrHabit],
            'habit_id' => ['integer', 'exists:habits,id', new EitherGoalOrHabit],
            'title' => ['required', 'string', 'max:255'],
            'details' => ['string'],
            'all_day' => ['boolean'],
            'urgent' => ['boolean'],
            'recurrence_type' => ['string', Rule::in(array_column(RepeatTypes::cases(), 'value'))],
            'start_date' => ['date', 'after_or_equal:today'],
            'end_date' => ['date', 'after_or_equal:start_date'],

        ];
    }

    public function messages(): array
    {
        return [
            'recurrence_type.in' => 'The recurrence type must be one of: ' . implode(', ', array_column(RepeatTypes::cases(), 'value')),
        ];
    }
}

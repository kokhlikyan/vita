<?php

namespace App\Http\Requests;

use App\Enums\RepeatTypes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateHabitRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'details' => ['string'],
            'tasks' => ['array'],
            'tasks.*.title' => ['required', 'string', 'max:255'],
            'tasks.*.details' => ['string'],
            'tasks.*.all_day' => ['boolean'],
            'tasks.*.block_id' => ['integer', 'exists:blocks,id'],
            'tasks.*.recurrence_interval' => ['integer'],
            'tasks.*.recurrence_type' => ['string', Rule::in(array_column(RepeatTypes::cases(), 'value'))],
            'tasks.*.start_date' => ['date', 'after_or_equal:today'],
            'tasks.*.end_date' => ['date', 'after_or_equal:start_date'],
        ];
    }
}

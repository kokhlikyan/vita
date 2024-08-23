<?php

namespace App\Http\Requests;

use App\Enums\BlockRepeatTypes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlockRequest extends FormRequest
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
        $blockTypesString = implode(',', array_column(BlockRepeatTypes::cases(), 'value'));
        return [
            'title' => ['string', 'max:255'],
            'details' => ['string'],
            'type' => ['string', 'max:255', 'in:' . $blockTypesString],
            'start_date' => [
                'required_if:type,temporary',
                'date',
                'date_format:Y-m-d',
                'after:now', // 'start_date' must be greater than or equal to today
            ],
            'end_date' => [
                'required_if:type,temporary',
                'date',
                'date_format:Y-m-d',
                'after:start_date', // 'end_date' must be greater than 'start_date
            ],
            'start_time' => ['date_format:H:i'],
            'end_time' => ['date_format:H:i',  'after:start_time'],
            'color' => ['string', 'max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'type.in' => 'The :attribute must be one of the following values: ' . implode(',', array_column(BlockTypes::cases(), 'value')),
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\BlockTypes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateBlockRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $blockTypesString = implode(',', array_column(BlockTypes::cases(), 'value'));

        return [
            'title' => ['required', 'string', 'max:255'],
            'details' => ['string'],
            'type' => ['required', 'string', 'max:255', 'in:' . $blockTypesString],
            'start_date' => [
                'required_if:type,temporary',
                'date',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'required_if:type,temporary',
                'date',
                'date_format:Y-m-d',
                'after:start_date'
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i',  'after:start_time'],
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

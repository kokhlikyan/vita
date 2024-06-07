<?php

namespace App\Http\Requests;

use App\Enums\BlockTypes;
use App\Rules\StartBeforeEndDate;
use App\Rules\StartBeforeEndTime;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $blockTypesString = implode(',', array_column(BlockTypes::cases(), 'value'));
        return [
            'name' => ['required', 'string', 'max:255'],
            'purpose' => ['string'],
            'type' => ['required', 'string', 'max:255', 'in:' . $blockTypesString],
            'start_date' => [
                'required_if:type,temporary',
                'date_format:d.m.Y',
            ],
            'end_date' => [
                'required_if:type,temporary',
                'date_format:d.m.Y',
                new StartBeforeEndDate,
            ],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i',  new StartBeforeEndTime],
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

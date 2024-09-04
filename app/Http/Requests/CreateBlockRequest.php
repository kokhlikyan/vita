<?php

namespace App\Http\Requests;

use App\Enums\BlockRepeatTypes;
use App\Rules\AfterNowTime;
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
        $blockTypesString = implode(',', array_column(BlockRepeatTypes::cases(), 'value'));

        return [
            'title' => ['required', 'string', 'max:255'],
             'details' => ['nullable', 'string'],
            'repeat_every' => ['integer', 'min:1'],
            'repeat_type' => ['string', 'max:255', 'in:' . $blockTypesString],
            'repeat_on' => ['required_if:repeat_type,week', 'array', 'max:7', 'min:1', 'in:0,1,2,3,4,5,6'],
            'repeat_on.*' => ['integer', 'min:0', 'max:6'],
            'start_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today'
            ],
            'end_date' => [
                'date',
                'date_format:Y-m-d',
                'after_or_equal:start_date'
            ],
            'from_time' => ['required', 'date_format:H:i',  new AfterNowTime()],
            'to_time' => ['required', 'date_format:H:i',  'after:from_time'],
            'color' => ['string', 'max:255'],
            'end_on' => ['date', 'date_format:Y-m-d'],
            'end_after' => ['integer', 'min:1',],
        ];
    }
    public function messages(): array
    {
        return [
            'type.in' => 'The :attribute must be one of the following values: ' . implode(',', array_column(BlockRepeatTypes::cases(), 'value')),
        ];
    }
}

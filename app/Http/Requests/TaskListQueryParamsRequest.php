<?php

namespace App\Http\Requests;

use App\Enums\TaskListOrderByValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskListQueryParamsRequest extends FormRequest
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
        return [
            'search' => ['string', 'max:255'],
            'sort' => ['int', 'min:1', 'max:365'],
            'date' => ['date'],
            'page' => ['int', 'min:1'],
            'type' => ['string', 'nullable'],
            'today' => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'The type must be one of the following: independent, goal, habit, block.',
        ];
    }
}

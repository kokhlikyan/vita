<?php

namespace App\Http\Requests;

use App\Enums\BlockTypes;
use Illuminate\Foundation\Http\FormRequest;

class AuthWithTokenRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
        ];
    }
}

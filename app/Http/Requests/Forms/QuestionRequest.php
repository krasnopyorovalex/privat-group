<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\NotUrl;

/**
 * Class QuestionRequest
 * @package App\Http\Requests\Forms
 */
class QuestionRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'phone' => ['required', 'string', 'min:5', new NotUrl],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле «email» обязательно для заполнения',
            'phone.required' => 'Поле «Телефон» обязательно для заполнения'
        ];
    }
}

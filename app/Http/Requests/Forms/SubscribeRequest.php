<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

/**
 * Class SubscribeRequest
 * @package App\Http\Requests\Forms
 */
class SubscribeRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string',
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
            'email.required' => 'Поле «Email» обязательно для заполнения',
            'phone.required' => 'Поле «Телефон» обязательно для заполнения'
        ];
    }
}

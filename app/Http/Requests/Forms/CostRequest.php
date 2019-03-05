<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

/**
 * Class CostRequest
 * @package App\Http\Requests\Forms
 */
class CostRequest extends Request
{
    public function rules(): array
    {
        return [
            'date_in' => 'required|date_format:"d.m.Y"|after_or_equal:today',
            'date_out' => 'required|date_format:"d.m.Y"|after:date_in',
            'name' => 'required|string|min:3',
            'phone' => 'required|string',
            'email' => 'required|email'
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
            'date_in.required' => 'Поле «Дата заезда» обязательно для заполнения',
            'date_out.required' => 'Поле «Дата выезда» обязательно для заполнения',
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'phone.required' => 'Поле «Телефон» обязательно для заполнения',
            'email.required' => 'Поле «Email» обязательно для заполнения',
            'name.min' => 'Поле «Имя» обязательно для заполнения',
            'date_in.after_or_equal' => 'Поле «Дата заезда» введено некорректно',
            'date_out.after' => 'Поле «Дата выезда» введено некорректно',
        ];
    }
}

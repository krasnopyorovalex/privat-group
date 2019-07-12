<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\NotUrl;
use App\Rules\ServiceItem;

/**
 * Class OrderServiceItemRequest
 * @package App\Http\Requests\Forms
 */
class OrderServiceItemRequest extends Request
{
    public function rules(): array
    {
        return [
            'service' => ['required', 'string', new ServiceItem],
            'name' => ['required', 'string', 'min:3', new NotUrl],
            'phone' => ['required', 'string', 'min:3', new NotUrl],
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
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'phone.required' => 'Поле «Телефон» обязательно для заполнения'
        ];
    }
}

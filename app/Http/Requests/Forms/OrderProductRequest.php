<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\CatalogProduct;
use App\Rules\NotUrl;

/**
 * Class OrderProductRequest
 * @package App\Http\Requests\Forms
 */
class OrderProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'product' => ['required', 'string', new CatalogProduct],
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

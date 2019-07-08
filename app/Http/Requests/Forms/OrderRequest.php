<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\CatalogProduct;
use App\Rules\NotUrl;

/**
 * Class OrderRequest
 * @package App\Http\Requests\Forms
 */
class OrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'product' => ['required', 'string', new CatalogProduct],
            'phone' => ['required', 'string', 'min:3', new NotUrl],
            'name' => ['required', 'string', 'min:3', new NotUrl],
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

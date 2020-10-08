<?php

namespace Domain\CatalogProduct\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateCatalogProductRequest
 * @package Domain\CatalogProduct\Requests
 */
class UpdateCatalogProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'price' => 'integer|max:4294967295',
            'label' => 'string|max:16|nullable',
            'title' => 'required|max:512',
            'description' => 'max:512|nullable',
            'text' => 'string|nullable',
            'preview' => 'string|nullable',
            'props' => 'string|nullable',
            'pos' => 'integer|min:0|max:255',
            'on_request' => 'boolean',
            'address' => 'string|nullable'
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'text.required' => 'Поле «Текст» обязательно для заполнения'
        ];
    }
}

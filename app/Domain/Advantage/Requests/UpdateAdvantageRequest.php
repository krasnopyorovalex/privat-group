<?php

namespace Domain\Advantage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateAdvantageRequest
 * @package Domain\Advantage\Requests
 */
class UpdateAdvantageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'preview' => 'string|nullable',
            'pos' => 'integer|min:0|max:255',
            'image' => 'image',
            'imageAlt' => 'string|max:255',
            'imageTitle' => 'string|max:255'
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
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}

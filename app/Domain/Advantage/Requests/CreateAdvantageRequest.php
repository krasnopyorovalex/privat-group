<?php

namespace Domain\Advantage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateAdvantageRequest
 * @package Domain\Advantage\Requests
 */
class CreateAdvantageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'preview' => 'required|string',
            'pos' => 'integer|min:0|max:255',
            'image' => 'image'
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
            'preview.required'  => 'Поле «Превью» обязательно для заполнения'
        ];
    }
}

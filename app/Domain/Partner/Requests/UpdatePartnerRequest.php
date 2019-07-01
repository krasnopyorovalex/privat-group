<?php

namespace Domain\Partner\Requests;

use App\Http\Requests\Request;


/**
 * Class UpdatePartnerRequest
 * @package Domain\Partner\Requests
 */
class UpdatePartnerRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:255',
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
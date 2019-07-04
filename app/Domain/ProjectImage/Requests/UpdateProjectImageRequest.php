<?php

namespace Domain\ProjectImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateProjectImageRequest
 * @package Domain\ProjectImage\Requests
 */
class UpdateProjectImageRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'is_published' => 'digits_between:0,1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле «Название» обязательно для заполнения',
        ];
    }
}

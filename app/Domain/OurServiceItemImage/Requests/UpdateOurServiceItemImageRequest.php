<?php

namespace Domain\OurServiceItemImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateOurServiceItemImageRequest
 * @package Domain\OurServiceItemImage\Requests
 */
class UpdateOurServiceItemImageRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
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
    public function messages(): array
    {
        return [
            'name.required' => 'Поле «Название» обязательно для заполнения',
        ];
    }
}

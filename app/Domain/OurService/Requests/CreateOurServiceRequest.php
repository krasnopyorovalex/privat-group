<?php

namespace Domain\OurService\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateOurServiceRequest
 * @package Domain\OurService\Requests
 */
class CreateOurServiceRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'title' => 'required|max:512',
            'description' => 'max:512',
            'text' => 'string|nullable',
            'preview' => 'string|nullable',
            'alias' => 'required|max:64|unique:our_services',
            'image' => 'image',
            'showed_in_main' => 'digits_between:0,1',
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
            'title.required'  => 'Поле «Title» обязательно для заполнения',
            'alias.required'  => 'Поле «Alias» обязательно для заполнения',
            'alias.unique'  => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}

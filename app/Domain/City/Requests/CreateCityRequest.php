<?php

declare(strict_types=1);

namespace Domain\City\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCityRequest
 * @package Domain\City\Requests
 */
class CreateCityRequest extends Request
{
    public function rules(): array
    {
        return [
            'alias' => 'bail|required|unique:cities|max:64',
            'name' => 'required|max:64',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
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
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}

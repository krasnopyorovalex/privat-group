<?php

namespace Domain\Project\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateProjectRequest
 * @package Domain\Project\Requests
 */
class CreateProjectRequest extends Request
{
    public function rules(): array
    {
        return [
            'alias' => 'bail|required|unique:projects|max:64',
            'name' => 'required|max:512',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'preview' => 'string|nullable',
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
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}

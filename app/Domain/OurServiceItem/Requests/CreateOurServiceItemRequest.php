<?php

namespace Domain\OurServiceItem\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateOurServiceItemRequest
 * @package Domain\OurServiceItem\Requests
 */
class CreateOurServiceItemRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'our_service_id' => 'required|numeric|exists:our_services,id',
            'title' => 'required|max:512',
            'description' => 'max:512|nullable',
            'text' => 'string|nullable',
            'alias' => 'required|max:255|unique:our_service_items',
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
            'text.required' => 'Поле «Текст» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}

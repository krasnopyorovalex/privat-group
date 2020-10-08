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
            'name' => 'bail|required|max:512'
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

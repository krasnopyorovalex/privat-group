<?php

namespace Domain\ProjectImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateProjectImageRequest
 * @package Domain\ProjectImage\Requests
 */
class CreateProjectImageRequest extends Request
{
    public function rules()
    {
        return [
            'upload' => 'image',
            'productId' => 'integer'
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
            'upload.image' => 'Разрешено загружать только изображения',
            'productId.integer' => 'Поле «id продукта» должно быть целым числом'
        ];
    }
}

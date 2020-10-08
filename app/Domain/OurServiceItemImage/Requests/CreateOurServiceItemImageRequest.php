<?php

namespace Domain\OurServiceItemImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateOurServiceItemImageRequest
 * @package Domain\OurServiceItemImage\Requests
 */
class CreateOurServiceItemImageRequest extends Request
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

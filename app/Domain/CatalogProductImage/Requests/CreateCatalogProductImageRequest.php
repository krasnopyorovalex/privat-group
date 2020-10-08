<?php

namespace Domain\CatalogProductImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCatalogProductImageRequest
 * @package Domain\CatalogProductImage\Requests
 */
class CreateCatalogProductImageRequest extends Request
{
    public function rules()
    {
        return [
            'upload' => 'image',
            'catalogProductId' => 'integer'
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
            'catalogProductId.integer' => 'Поле «id товара» должно быть целым числом'
        ];
    }
}

<?php

namespace Domain\CatalogProductImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateCatalogProductImageRequest
 * @package Domain\CatalogProductImage\Requests
 */
class UpdateCatalogProductImageRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable'
        ];
    }
}

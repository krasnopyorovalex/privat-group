<?php

namespace Domain\SliderImage\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateSliderImageRequest
 * @package Domain\SliderImage\Requests
 */
class UpdateSliderImageRequest extends Request
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

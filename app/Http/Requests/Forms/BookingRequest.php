<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\Room;

/**
 * Class BookingRequest
 * @package App\Http\Requests\Forms
 */
class BookingRequest extends Request
{
    public function rules(): array
    {
        return [
            'room' => ['required', 'string', new Room],
            'date_in' => 'required|date_format:"d.m.Y"|after_or_equal:today',
            'date_out' => 'required|date_format:"d.m.Y"|after:date_in',
            'fio' => 'required|string|min:3',
            'phone' => 'required|string',
            'email' => 'required|email',
            'count_adults' => 'required|between:1,5',
            'count_child' => 'between:0,5|nullable',
            'dop__info' => 'string|nullable'
        ];
    }
}

<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\NotUrl;

/**
 * Class GuestbookCheckRequest
 * @package App\Http\Requests\Forms
 */
class GuestbookCheckRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'text' => ['required', 'string', new NotUrl],
            'agree' => 'required|integer'
        ];
    }
}

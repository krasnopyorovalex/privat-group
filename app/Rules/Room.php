<?php

namespace App\Rules;

use App\Domain\Service\Queries\ExistsServicesByNameQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Room implements Rule
{
    use DispatchesJobs;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->dispatch(new ExistsServicesByNameQuery($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

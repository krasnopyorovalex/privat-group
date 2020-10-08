<?php

namespace App\Rules;

use App\Domain\OurService\Queries\ExistsServiceByNameQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Service
 * @package App\Rules
 */
class Service implements Rule
{
    use DispatchesJobs;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool|mixed
     */
    public function passes($attribute, $value)
    {
        return $this->dispatch(new ExistsServiceByNameQuery($value));
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

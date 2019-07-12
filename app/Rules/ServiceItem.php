<?php

namespace App\Rules;

use App\Domain\OurServiceItem\Queries\ExistsServiceItemByNameQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ServiceItem
 * @package App\Rules
 */
class ServiceItem implements Rule
{
    use DispatchesJobs;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool|mixed
     */
    public function passes($attribute, $value)
    {
        return $this->dispatch(new ExistsServiceItemByNameQuery($value));
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

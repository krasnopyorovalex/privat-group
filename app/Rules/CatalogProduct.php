<?php

namespace App\Rules;

use App\Domain\CatalogProduct\Queries\ExistsCatalogProductByNameQuery;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CatalogProduct
 * @package App\Rules
 */
class CatalogProduct implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool|mixed
     */
    public function passes($attribute, $value)
    {
        return $this->dispatch(new ExistsCatalogProductByNameQuery($value));
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

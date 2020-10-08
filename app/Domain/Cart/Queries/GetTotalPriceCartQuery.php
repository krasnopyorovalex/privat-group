<?php

namespace App\Domain\Cart\Queries;


/**
 * Class GetTotalPriceCartQuery
 * @package App\Domain\Cart\Queries
 */
class GetTotalPriceCartQuery
{
    /**
     * @return float
     */
    public function handle(): float
    {
        return app('cart')->getTotal();
    }
}

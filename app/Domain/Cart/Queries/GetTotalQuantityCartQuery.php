<?php

namespace App\Domain\Cart\Queries;


/**
 * Class GetTotalQuantityCartQuery
 * @package App\Domain\Cart\Queries
 */
class GetTotalQuantityCartQuery
{
    /**
     * @return float
     */
    public function handle(): float
    {
        return app('cart')->getTotalQuantity();
    }
}

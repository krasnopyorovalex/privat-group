<?php

namespace App\Domain\Cart\Queries;

use Darryldecode\Cart\CartCollection;

/**
 * Class GetAllItemsCartQuery
 * @package App\Domain\Cart\Queries
 */
class GetAllItemsCartQuery
{
    /**
     * @return CartCollection
     */
    public function handle(): CartCollection
    {
        return app('cart')->getContent();
    }
}

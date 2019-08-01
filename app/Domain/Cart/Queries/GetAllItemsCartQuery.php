<?php

namespace App\Domain\Cart\Queries;

use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCollection;

/**
 * Class GetAllItemsCartQuery
 * @package App\Domain\Cart\Queries
 */
class GetAllItemsCartQuery
{
    /**
     * @var Cart
     */
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return CartCollection
     */
    public function handle(): CartCollection
    {
        return $this->cart->getContent();
    }
}

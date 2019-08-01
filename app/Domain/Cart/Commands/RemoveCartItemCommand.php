<?php

namespace App\Domain\Cart\Commands;

use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use App\Http\Requests\Request;
use Darryldecode\Cart\Cart;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RemoveCartItemCommand
 * @package App\Domain\Cart\Commands
 */
class RemoveCartItemCommand
{
    use DispatchesJobs;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var Cart
     */
    private $cart;


    /**
     * RemoveCartItemCommand constructor.
     * @param Cart $cart
     * @param Request $request
     */
    public function __construct(Cart $cart, Request $request)
    {
        $this->request = $request;
        $this->cart = $cart;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $product = $this->dispatch(new GetCatalogProductByIdQuery($this->request->post('product')));

        return $this->cart->remove($product->id);
    }

}

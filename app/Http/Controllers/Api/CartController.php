<?php

namespace App\Http\Controllers\Api;

use App\Domain\Cart\Commands\AddToCartCommand;
use App\Domain\Cart\Commands\RemoveCartItemCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Darryldecode\Cart\CartCollection;

/**
 * Class CartController
 * @package App\Http\Controllers\Api
 */
class CartController extends Controller
{
    /**
     * @param int $product
     * @return string
     */
    public function add(int $product): string
    {
        /** @var $response CartCollection */
        $response = $this->dispatch(new AddToCartCommand($product));

        return $response->toJson();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function remove(Request $request)
    {
        return $this->dispatch(new RemoveCartItemCommand($this->cart, $request));
    }
}

<?php

namespace App\Domain\Cart\Commands;

use App\Domain\Cart\Queries\GetAllItemsCartQuery;
use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Darryldecode\Cart\CartCollection;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Cart;

/**
 * Class AddToCartCommand
 * @package App\Domain\Cart\Commands
 */
class AddToCartCommand
{
    use DispatchesJobs;

    private const MINUTES_TO_SAVE = 2880; // two days
    private const COOKIE_KEY = 'session';

    private $product;

    /**
     * AddToCartCommand constructor.
     * @param int $product
     */
    public function __construct(int $product)
    {
        $this->product = $product;
    }

    /**
     * @return CartCollection
     * @throws Exception
     */
    public function handle(): CartCollection
    {
        $product = $this->dispatch(new GetCatalogProductByIdQuery($this->product));

//        $cookie = Cookie::get(self::COOKIE_KEY);
//
//        if (!$cookie) {
//            $user = md5(Str::random(11));
//            $cookie = cookie(self::COOKIE_KEY, $user, self::MINUTES_TO_SAVE);
//        }

        $cart = Cart::session(self::COOKIE_KEY)
            ->add($product->id, $product->name, $product->price, 1, []);

        return $this->dispatch(new GetAllItemsCartQuery($cart));
    }
}

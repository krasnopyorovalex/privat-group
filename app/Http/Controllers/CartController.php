<?php

namespace App\Http\Controllers;

use App\Domain\Cart\Commands\AddToCartCommand;
use App\Domain\Cart\Commands\ClearCartCommand;
use App\Domain\Cart\Commands\RemoveCartItemCommand;
use App\Domain\Cart\Commands\UpdateCartCountCommand;
use App\Domain\Cart\Queries\GetAllItemsCartQuery;
use App\Domain\Cart\Queries\GetTotalPriceCartQuery;
use App\Domain\Cart\Queries\GetTotalQuantityCartQuery;
use App\Domain\Page\Queries\GetPageByAliasQuery;
use App\Mail\CheckoutCartSent;
use Darryldecode\Cart\CartCollection;
use Domain\Cart\Requests\CheckoutCartRequest;
use Mail;

/**
 * Class CartController
 * @package App\Http\Controllers\Api
 */
class CartController extends Controller
{
    /**
     * @param string $alias
     * @return string
     */
    public function index(string $alias = 'cart'): string
    {
        $page = $this->dispatch(new GetPageByAliasQuery($alias));
        $items = $this->dispatch(new GetAllItemsCartQuery());
        $total = $this->dispatch(new GetTotalPriceCartQuery());

        return view('cart.index', [
            'page' => $page,
            'items' => $items,
            'total' => number_format($total, 0, '.', ' ')

        ]);
    }

    /**
     * @param int $product
     * @return array
     */
    public function add(int $product): array
    {
        /** @var $response CartCollection */
        $response = $this->dispatch(new AddToCartCommand($product));
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'content' => $response->toJson(),
            'message' => 'Товар добавлен в корзину',
            'quantity' => $quantity
        ];
    }

    /**
     * @param int $product
     * @return array
     */
    public function remove(int $product): array
    {
        $status = $this->dispatch(new RemoveCartItemCommand($product));
        $total = $this->dispatch(new GetTotalPriceCartQuery());
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'status' => $status,
            'message' => 'Товар удален',
            'total' => number_format($total, 0, '.', ' '),
            'quantity' => $quantity
        ];
    }

    /**
     * @param int $product
     * @param int $quantity
     * @return array
     */
    public function update(int $product, int $quantity): array
    {
        $product = $this->dispatch(new UpdateCartCountCommand($product, $quantity));
        $total = $this->dispatch(new GetTotalPriceCartQuery());
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'product' => $product,
            'productPrice' => number_format($product->price * $product->quantity, 0, '.', ' '),
            'message' => 'Количество обновлено',
            'total' => number_format($total, 0, '.', ' '),
            'quantity' => $quantity
        ];
    }

    /**
     * @param CheckoutCartRequest $request
     * @return array
     */
    public function order(CheckoutCartRequest $request): array
    {
        //fabrikabani@mail.ru
        Mail::to(['djShtaket88@mail.ru'])->send(new CheckoutCartSent($request->all()));

        $this->dispatch(new ClearCartCommand);

        return [
            'message' => 'Ваша заявка отправлена успешно. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200,
            'clear' => true
        ];
    }
}

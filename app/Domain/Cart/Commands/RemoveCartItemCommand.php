<?php

namespace App\Domain\Cart\Commands;

use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RemoveCartItemCommand
 * @package App\Domain\Cart\Commands
 */
class RemoveCartItemCommand
{
    use DispatchesJobs;
    /**
     * @var int
     */
    private $product;


    /**
     * RemoveCartItemCommand constructor.
     * @param int $product
     */
    public function __construct(int $product)
    {
        $this->product = $product;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $product = $this->dispatch(new GetCatalogProductByIdQuery($this->product));

        return app('cart')->remove($product->id);
    }
}

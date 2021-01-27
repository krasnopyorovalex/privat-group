<?php

namespace App\Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class GetCatalogProductByAliasQuery
 * @package App\Domain\CatalogProduct\Queries
 */
class GetCatalogProductByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetCatalogProductByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $catalogProduct = CatalogProduct::where('alias', $this->alias)->with(['images'])->firstOrFail();
        $catalogProduct->images->each->setRelation('catalogProduct', $catalogProduct);

        return $catalogProduct;
    }
}

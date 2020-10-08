<?php

namespace App\Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class ExistsCatalogProductByAliasQuery
 * @package App\Domain\CatalogProduct\Queries
 */
class ExistsCatalogProductByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * ExistsCatalogProductByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        return CatalogProduct::where('alias', $this->alias)->exists();
    }
}

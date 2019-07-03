<?php

namespace App\Domain\CatalogProduct\Queries;

use App\Catalog;
use App\CatalogProduct;

/**
 * Class GetAllCatalogsQuery
 * @property Catalog catalog
 * @package App\Domain\CatalogProduct\Queries
 */
class GetAllCatalogProductsQuery
{
    private $catalog;

    private $excludedId;

    /**
     * GetAllCatalogProductsQuery constructor.
     * @param null $catalog
     * @param null $excludedId
     */
    public function __construct($catalog = null, $excludedId = null)
    {
        $this->catalog = $catalog;
        $this->excludedId = $excludedId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = CatalogProduct::with(['catalog'])->orderBy('pos');

        if ($this->catalog) {
            $query->where('catalog_id', $this->catalog);
        }

        if ($this->excludedId) {
            $query->where('id', '<>', $this->excludedId);
        }

        return $query->get();
    }
}

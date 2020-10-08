<?php

namespace App\Domain\CatalogProductImage\Queries;

use App\CatalogProductImage;

/**
 * Class GetCatalogProductImageByIdQuery
 * @package App\Domain\CatalogProductImage\Queries
 */
class GetCatalogProductImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetCatalogProductImageByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return CatalogProductImage::findOrFail($this->id);
    }
}

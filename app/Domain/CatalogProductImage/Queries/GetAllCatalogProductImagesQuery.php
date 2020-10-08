<?php

namespace App\Domain\Gallery\Queries;

use App\CatalogProductImage;

/**
 * Class GetAllCatalogProductImagesQuery
 * @package App\Domain\Gallery\Queries
 */
class GetAllCatalogProductImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return CatalogProductImage::all();
    }
}

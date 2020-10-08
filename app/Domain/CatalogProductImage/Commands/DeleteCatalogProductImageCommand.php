<?php

namespace App\Domain\CatalogProductImage\Commands;

use App\Domain\CatalogProductImage\Queries\GetCatalogProductImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteCatalogProductImageCommand
 * @package App\Domain\CatalogProductImage\Commands
 */
class DeleteCatalogProductImageCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteCatalogProductImageCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $image = $this->dispatch(new GetCatalogProductImageByIdQuery($this->id));

        Storage::delete([
            'public/catalog_products/' . $image->catalog_product_id . '/' . $image->basename . '.' . $image->ext,
            'public/catalog_products/' . $image->catalog_product_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}

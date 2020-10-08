<?php

namespace App\Domain\CatalogProductImage\Commands;

use App\CatalogProductImage;
use App\Services\UploadImagesService;

/**
 * Class CreateCatalogProductImageCommand
 * @package App\Domain\CatalogProductImage\Commands
 */
class CreateCatalogProductImageCommand
{

    private $uploadImage;

    /**
     * CreateCatalogProductImageCommand constructor.
     * @param UploadImagesService $uploadImage
     */
    public function __construct(UploadImagesService $uploadImage)
    {
        $this->uploadImage = $uploadImage;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $CatalogProductImage = new CatalogProductImage();
        $CatalogProductImage->basename = $this->uploadImage->getImageHashName();
        $CatalogProductImage->ext = $this->uploadImage->getExt();
        $CatalogProductImage->catalog_product_id = $this->uploadImage->getEntityId();

        return $CatalogProductImage->save();
    }
}

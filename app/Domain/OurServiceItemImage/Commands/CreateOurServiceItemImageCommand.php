<?php

namespace App\Domain\OurServiceItemImage\Commands;

use App\OurServiceItemImage;
use App\Services\UploadImagesService;

/**
 * Class CreateOurServiceItemImageCommand
 * @package App\Domain\OurServiceItemImage\Commands
 */
class CreateOurServiceItemImageCommand
{

    private $uploadImage;

    /**
     * CreateOurServiceItemImageCommand constructor.
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
        $productImage = new OurServiceItemImage();
        $productImage->basename = $this->uploadImage->getImageHashName();
        $productImage->ext = $this->uploadImage->getExt();
        $productImage->our_service_item_id = $this->uploadImage->getEntityId();

        return $productImage->save();
    }

}

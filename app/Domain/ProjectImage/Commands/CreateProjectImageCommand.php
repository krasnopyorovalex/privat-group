<?php

namespace App\Domain\ProjectImage\Commands;

use App\ProjectImage;
use App\Services\UploadImagesService;

/**
 * Class CreateProjectImageCommand
 * @package App\Domain\ProjectImage\Commands
 */
class CreateProjectImageCommand
{

    private $uploadImage;

    /**
     * CreateProjectImageCommand constructor.
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
        $projectImage = new ProjectImage();
        $projectImage->basename = $this->uploadImage->getImageHashName();
        $projectImage->ext = $this->uploadImage->getExt();
        $projectImage->project_id = $this->uploadImage->getEntityId();

        return $projectImage->save();
    }

}

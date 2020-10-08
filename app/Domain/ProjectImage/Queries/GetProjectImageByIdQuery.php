<?php

namespace App\Domain\ProjectImage\Queries;

use App\ProjectImage;

/**
 * Class GetProjectImageByIdQuery
 * @package App\Domain\ProjectImage\Queries
 */
class GetProjectImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetProjectImageByIdQuery constructor.
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
        return ProjectImage::findOrFail($this->id);
    }
}

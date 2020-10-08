<?php

namespace App\Domain\OurServiceItemImage\Queries;

use App\OurServiceItemImage;

/**
 * Class GetOurServiceItemImageByIdQuery
 * @package App\Domain\OurServiceItemImage\Queries
 */
class GetOurServiceItemImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetOurServiceItemImageByIdQuery constructor.
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
        return OurServiceItemImage::findOrFail($this->id);
    }
}

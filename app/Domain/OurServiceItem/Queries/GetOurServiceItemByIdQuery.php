<?php

namespace App\Domain\OurServiceItem\Queries;

use App\OurServiceItem;

/**
 * Class GetOurServiceItemByIdQuery
 * @package App\Domain\OurServiceItem\Queries
 */
class GetOurServiceItemByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetOurServiceItemByIdQuery constructor.
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
        return OurServiceItem::findOrFail($this->id);
    }
}

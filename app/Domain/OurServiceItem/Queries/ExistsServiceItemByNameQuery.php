<?php

namespace App\Domain\OurServiceItem\Queries;

use App\OurServiceItem;

/**
 * Class ExistsServiceItemByNameQuery
 * @package App\Domain\OurServiceItem\Queries
 */
class ExistsServiceItemByNameQuery
{
    /**
     * @var string
     */
    private $name;

    /**
     * ExistsServiceByNameQuery constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return OurServiceItem::where('name', $this->name)->firstOrFail();
    }
}

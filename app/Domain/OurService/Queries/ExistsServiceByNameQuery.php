<?php

namespace App\Domain\OurService\Queries;

use App\OurService;

/**
 * Class ExistsServiceByNameQuery
 * @package App\Domain\OurService\Queries
 */
class ExistsServiceByNameQuery
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
        return OurService::where('name', $this->name)->firstOrFail();
    }
}

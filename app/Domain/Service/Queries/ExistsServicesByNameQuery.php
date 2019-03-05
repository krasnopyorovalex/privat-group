<?php

namespace App\Domain\Service\Queries;

use App\Service;

/**
 * Class ExistsServicesByNameQuery
 * @package App\Domain\Service\Queries
 */
class ExistsServicesByNameQuery
{
    /**
     * @var string
     */
    private $service;

    /**
     * ExistsServicesByNameQuery constructor.
     * @param string $service
     */
    public function __construct(string $service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Service::where('name', $this->service)->exists();
    }
}
<?php

namespace App\Domain\Service\Queries;

use App\Service;

/**
 * Class GetServiceByIdQuery
 * @package App\Domain\Service\Queries
 */
class GetServiceByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetServiceByIdQuery constructor.
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
        return Service::with(['relativeServices', 'tabs'])->findOrFail($this->id);
    }
}
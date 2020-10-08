<?php

namespace App\Domain\OurService\Queries;

use App\OurService;

/**
 * Class GetOurServiceByIdQuery
 * @package App\Domain\OurService\Queries
 */
class GetOurServiceByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetOurServiceByIdQuery constructor.
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
        return OurService::with(['image'])->findOrFail($this->id);
    }
}

<?php

namespace App\Domain\Advantage\Queries;

use App\Advantage;

/**
 * Class GetAdvantageByIdQuery
 * @package App\Domain\Advantage\Queries
 */
class GetAdvantageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetAdvantageByIdQuery constructor.
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
        return Advantage::with(['image'])->findOrFail($this->id);
    }
}

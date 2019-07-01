<?php

namespace App\Domain\Partner\Queries;

use App\Partner;

/**
 * Class GetPartnerByIdQuery
 * @package App\Domain\Partner\Queries
 */
class GetPartnerByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetPartnerByIdQuery constructor.
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
        return Partner::findOrFail($this->id);
    }
}
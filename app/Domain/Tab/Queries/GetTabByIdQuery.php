<?php

namespace App\Domain\Tab\Queries;

use App\Tab;

/**
 * Class GetTabByIdQuery
 * @package App\Domain\Tab\Queries
 */
class GetTabByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetTabByIdQuery constructor.
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
        return Tab::findOrFail($this->id);
    }
}
<?php

namespace App\Domain\Project\Queries;

use App\Project;

/**
 * Class GetProjectByIdQuery
 * @package App\Domain\Project\Queries
 */
class GetProjectByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetProjectByIdQuery constructor.
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
        return Project::with(['image'])->findOrFail($this->id);
    }
}

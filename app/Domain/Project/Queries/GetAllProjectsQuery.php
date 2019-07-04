<?php

namespace App\Domain\Project\Queries;

use App\Project;

/**
 * Class GetAllProjectsQuery
 * @package App\Domain\Project\Queries
 */
class GetAllProjectsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Project::with(['image'])->get();
    }
}

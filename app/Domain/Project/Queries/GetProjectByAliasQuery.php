<?php

namespace App\Domain\Project\Queries;

use App\Project;

/**
 * Class GetProjectByAliasQuery
 * @package App\Domain\Project\Queries
 */
class GetProjectByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetProjectByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Project::where('alias', $this->alias)->firstOrFail();
    }
}

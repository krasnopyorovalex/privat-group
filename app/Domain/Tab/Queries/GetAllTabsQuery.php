<?php

namespace App\Domain\Tab\Queries;

use App\Tab;

/**
 * Class GetAllTabsQuery
 * @package App\Domain\Tab\Queries
 */
class GetAllTabsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Tab::all();
    }
}
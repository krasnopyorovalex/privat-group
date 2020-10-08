<?php

namespace App\Domain\Advantage\Queries;

use App\Advantage;

/**
 * Class GetAllAdvantagesQuery
 * @package App\Domain\Advantage\Queries
 */
class GetAllAdvantagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Advantage::orderBy('pos', 'asc')->get();
    }
}

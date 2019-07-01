<?php

namespace App\Domain\Partner\Queries;

use App\Partner;

/**
 * Class GetAllPartnersQuery
 * @package App\Domain\Partner\Queries
 */
class GetAllPartnersQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Partner::with(['image'])->get();
    }
}
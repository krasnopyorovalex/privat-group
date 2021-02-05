<?php

declare(strict_types=1);

namespace App\Domain\City\Queries;

use App\City;

/**
 * Class GetAllCitiesQuery
 * @package App\Domain\City\Queries
 */
class GetAllCitiesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return City::all();
    }
}
<?php

declare(strict_types=1);

namespace App\Domain\City\Queries;

use App\City;

/**
 * Class GetCityByIdQuery
 * @package App\Domain\City\Queries
 */
class GetCityByIdQuery
{
    private int $id;

    /**
     * GetCityByIdQuery constructor.
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
        return City::findOrFail($this->id);
    }
}
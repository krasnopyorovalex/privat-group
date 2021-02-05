<?php

declare(strict_types=1);

namespace App\Domain\City\Queries;

use App\City;

/**
 * Class GetCityByAliasQuery
 * @package App\Domain\City\Queries
 */
class GetCityByAliasQuery
{
    private string $alias;

    /**
     * GetCityByAliasQuery constructor.
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
        return City::where('alias', $this->alias)->where('is_published', '1')->firstOrFail();
    }
}
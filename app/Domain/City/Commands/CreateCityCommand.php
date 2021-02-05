<?php

declare(strict_types=1);

namespace App\Domain\City\Commands;

use App\Domain\CatalogProduct\Queries\ExistsCatalogProductByAliasQuery;
use App\Http\Requests\Request;
use App\City;
use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateCityCommand
 * @package App\Domain\City\Commands
 */
class CreateCityCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateCityCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function handle(): bool
    {
        $city = new City();
        $city->fill($this->request->validated());

        $city->alias = str_slug($this->request->post('alias'));

        while ($this->dispatch(new ExistsCatalogProductByAliasQuery($city->alias))) {
            $city->alias .= '-' . random_int(2, 100);
        }

        $city->save();
        return true;
    }

}
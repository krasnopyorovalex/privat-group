<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Catalog\Queries\GetAllCatalogsWithoutParentQuery;
use App\Domain\City\Queries\GetAllCitiesQuery;
use App\Domain\City\Queries\GetCityByAliasQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CityController
 * @package App\Http\Controllers
 */
class CityController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias)
    {
        $city = $this->dispatch(new GetCityByAliasQuery($alias));

        $products = $city->products()
            ->orderByDesc('label')
            ->orderBy('created_at')
            ->paginate();

        $catalogList = $products->pluck('catalog.name', 'catalog.alias')->unique();

        $catalogs = $this->dispatch(new GetAllCatalogsWithoutParentQuery());
        $cities = $this->dispatch(new GetAllCitiesQuery());

        return view('city.index', [
            'city' => $city,
            'grouped' => $products->groupBy('catalog.alias'),
            'catalogList' => $catalogList,
            'productsForLinks' => $products,
            'catalogs' => $catalogs,
            'cities' => $cities
        ]);
    }
}

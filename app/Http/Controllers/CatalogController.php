<?php

namespace App\Http\Controllers;

use App\CatalogProduct;
use App\Domain\Catalog\Queries\GetAllCatalogsWithoutParentQuery;
use App\Domain\Catalog\Queries\GetCatalogByAliasQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;

/**
 * Class CatalogController
 * @package App\Http\Controllers
 */
class CatalogController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias)
    {
        $catalog = $this->dispatch(new GetCatalogByAliasQuery($alias));

        $catalogs = $this->dispatch(new GetAllCatalogsWithoutParentQuery());

        $products = $catalog->products()->with(['images' => static function (HasMany $query) {
            $query->limit(3);
        }])->paginate();

        return view('catalog.index', [
            'catalog' => $catalog,
            'products' => $products,
            'catalogs' => $catalogs
        ]);
    }
}

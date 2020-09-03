<?php

declare(strict_types=1);

namespace App\Domain\Catalog\Queries;

use App\Catalog;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class GetAllCatalogsWithoutParentQuery
 * @package App\Domain\Catalog\Queries
 */
class GetAllCatalogsWithoutParentQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Catalog::with(['products','catalogs' => static function (HasMany $relation) {
            $relation->withCount('products');
        }])
            ->withCount('products')
            ->where('parent_id', null)
            ->orderBy('pos')
            ->get();
    }
}

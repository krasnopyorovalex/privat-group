<?php

namespace App\Domain\Catalog\Queries;

use App\Catalog;
use Illuminate\Support\Collection;

/**
 * Class GetAllCatalogsNotParentQuery
 * @package App\Domain\Catalog\Queries
 */
class GetAllCatalogsNotParentQuery
{
    /**
     * Execute the job.
     */
    public function handle(): Collection
    {
        return Catalog::orderBy('pos')->get();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use App\Domain\Catalog\Queries\GetAllCatalogsWithoutParentQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CategoriesComposer
 * @package App\Http\ViewComposers
 */
class CategoriesComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $categories = $this->dispatch(new GetAllCatalogsWithoutParentQuery());

        $view->with('categories', $categories);
    }
}

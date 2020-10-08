<?php

namespace App\Http\ViewComposers;

use App\Domain\Partner\Queries\GetAllPartnersQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PartnersComposer
 * @package App\Http\ViewComposers
 */
class PartnersComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $partners = $this->dispatch(new GetAllPartnersQuery());

        $view->with('partners', $partners);
    }
}
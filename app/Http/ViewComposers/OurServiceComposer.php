<?php

namespace App\Http\ViewComposers;

use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class OurServiceComposer
 * @package App\Http\ViewComposers
 */
class OurServiceComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());

        $view->with('ourServices', $ourServices);
    }
}

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
    public function compose(View $view)
    {
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());

        $ourServicesInMain = $ourServices->filter(function ($item) {
            return $item->showed_in_main == 1;
        });

        $view->with('ourServices', $ourServices);
        $view->with('ourServicesInMain', $ourServicesInMain);
    }
}

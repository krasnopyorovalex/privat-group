<?php

namespace App\Http\ViewComposers;

use App\Domain\Advantage\Queries\GetAllAdvantagesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AdvantageComposer
 * @package App\Http\ViewComposers
 */
class AdvantageComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $advantages = $this->dispatch(new GetAllAdvantagesQuery());

        $view->with('advantages', $advantages);
    }
}

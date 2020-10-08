<?php

namespace App\Http\Controllers;

use App\Domain\OurServiceItem\Queries\GetOurServiceItemByAliasQuery;
use App\OurServiceItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Exception;

/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends PageController
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias = 'index')
    {
        try {
            /** @var $service OurServiceItem*/
            $service = $this->dispatch(new GetOurServiceItemByAliasQuery($alias));
            $service->text = $this->parserService->parse($service);
        } catch (Exception $exception) {
            return parent::show($alias);
        }

        return view('service.index', [
            'service' => $service
        ]);
    }
}

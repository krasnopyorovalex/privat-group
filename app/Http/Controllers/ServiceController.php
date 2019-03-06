<?php

namespace App\Http\Controllers;

use App\Domain\Service\Queries\GetAllServicesQuery;
use App\Domain\Service\Queries\GetServiceByAliasQuery;
use App\Service;

/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends PageController
{
    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $alias = 'index')
    {
        try {
            /** @var $service Service*/
            $service = $this->dispatch(new GetServiceByAliasQuery($alias));
            $service->text = $this->parserService->parse($service);
            $service->tabs = $service->tabs->mapWithKeys(function ($item) {
                return [$item->tab_id => $item->value];
            });
            $anotherRooms = $this->dispatch(new GetAllServicesQuery($service));
        } catch (\Exception $exception) {
            return parent::show($alias);
        }

        return view('service.index', [
            'service' => $service,
            'anotherRooms' => $anotherRooms
        ]);
    }
}

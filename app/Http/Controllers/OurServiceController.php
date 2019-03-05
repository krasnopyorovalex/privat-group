<?php

namespace App\Http\Controllers;

use App\Domain\OurService\Queries\GetOurServiceByAliasQuery;

/**
 * Class OurServiceController
 * @package App\Http\Controllers
 */
class OurServiceController extends Controller
{
    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $alias)
    {
        $ourService = $this->dispatch(new GetOurServiceByAliasQuery($alias));

        return view('our_service.index', [
            'ourService' => $ourService
        ]);
    }
}

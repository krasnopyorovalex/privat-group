<?php

namespace App\Http\Controllers;

use App\Domain\Info\Queries\GetInfoByAliasQuery;

/**
 * Class InfoController
 * @package App\Http\Controllers
 */
class InfoController extends Controller
{
    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $alias)
    {
        $new = $this->dispatch(new GetInfoByAliasQuery($alias));

        return view('new.index', [
            'new' => $new
        ]);
    }
}

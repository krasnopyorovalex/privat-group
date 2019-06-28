<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

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
        return parent::show($alias);
    }
}

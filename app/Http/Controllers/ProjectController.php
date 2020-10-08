<?php

namespace App\Http\Controllers;

use App\Domain\Project\Queries\GetProjectByAliasQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias)
    {
        $project = $this->dispatch(new GetProjectByAliasQuery($alias));

        return view('project.index', [
            'project' => $project
        ]);
    }
}

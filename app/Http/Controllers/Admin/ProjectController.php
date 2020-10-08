<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Project\Commands\CreateProjectCommand;
use App\Domain\Project\Commands\DeleteProjectCommand;
use App\Domain\Project\Commands\UpdateProjectCommand;
use App\Domain\Project\Queries\GetAllProjectsQuery;
use App\Domain\Project\Queries\GetProjectByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\Project\Requests\UpdateProjectRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Admin
 */
class ProjectController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $projects = $this->dispatch(new GetAllProjectsQuery);

        return view('admin.projects.index', [
            'projects' => $projects
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * @param CreateProjectRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateProjectRequest $request)
    {
        $this->dispatch(new CreateProjectCommand($request));

        return redirect(route('admin.projects.index'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $project = $this->dispatch(new GetProjectByIdQuery($id));

        return view('admin.projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * @param $id
     * @param UpdateProjectRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $this->dispatch(new UpdateProjectCommand($id, $request));

        return redirect(route('admin.projects.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteProjectCommand($id));

        return redirect(route('admin.projects.index'));
    }
}

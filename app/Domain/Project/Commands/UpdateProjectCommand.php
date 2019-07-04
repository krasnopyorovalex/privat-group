<?php

namespace App\Domain\Project\Commands;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Domain\Project\Queries\GetProjectByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Project;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateProjectCommand
 * @package App\Domain\Project\Commands
 */
class UpdateProjectCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateProjectCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $project = $this->dispatch(new GetProjectByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($project->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($project->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($project->image) {
                $this->dispatch(new DeleteImageCommand($project->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $project->id, Project::class));
        }

        return $project->update($this->request->all());
    }

}

<?php

namespace App\Domain\Project\Commands;

use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Project;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateProjectCommand
 * @package App\Domain\Project\Commands
 */
class CreateProjectCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateProjectCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $project = new Project();
        $project->fill($this->request->all());
        $project->save();

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $project->id, Project::class));
        }

        return true;
    }

}

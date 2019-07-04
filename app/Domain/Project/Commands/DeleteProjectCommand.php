<?php

namespace App\Domain\Project\Commands;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Project\Queries\GetProjectByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteProjectCommand
 * @package App\Domain\Project\Commands
 */
class DeleteProjectCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteProjectCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $project = $this->dispatch(new GetProjectByIdQuery($this->id));

        if($project->image) {
            $this->dispatch(new DeleteImageCommand($project->image));
        }

        Storage::deleteDirectory('public/project/' . $this->id);

        return $project->delete();
    }

}

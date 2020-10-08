<?php

namespace App\Domain\ProjectImage\Commands;

use App\Domain\ProjectImage\Queries\GetProjectImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateProjectImageCommand
 * @package App\Domain\ProjectImage\Commands
 */
class UpdateProjectImageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateGalleryImageCommand constructor.
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
        $image = $this->dispatch(new GetProjectImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}

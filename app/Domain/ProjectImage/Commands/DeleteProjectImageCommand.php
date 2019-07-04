<?php

namespace App\Domain\ProjectImage\Commands;

use App\Domain\ProjectImage\Queries\GetProjectImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteProjectImageCommand
 * @package App\Domain\ProjectImage\Commands
 */
class DeleteProjectImageCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteGalleryImageCommand constructor.
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
        $image = $this->dispatch(new GetProjectImageByIdQuery($this->id));

        Storage::delete([
            'public/product/' . $image->project_id . '/' . $image->basename . '.' . $image->ext,
            'public/product/' . $image->project_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}

<?php

namespace App\Domain\ProjectImage\Commands;

use App\Domain\ProjectImage\Queries\GetProjectImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsProjectImageCommand
 * @package App\Domain\ProjectImage\Commands
 */
class UpdatePositionsProjectImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsProjectImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if( is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetProjectImageByIdQuery($imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}

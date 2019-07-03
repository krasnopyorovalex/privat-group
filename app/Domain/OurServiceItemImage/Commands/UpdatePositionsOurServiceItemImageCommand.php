<?php

namespace App\Domain\OurServiceItemImage\Commands;

use App\Domain\OurServiceItemImage\Queries\GetOurServiceItemImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsOurServiceItemImageCommand
 * @package App\Domain\OurServiceItemImage\Commands
 */
class UpdatePositionsOurServiceItemImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsOurServiceItemImageCommand constructor.
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
                $image = $this->dispatch(new GetOurServiceItemImageByIdQuery($imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}

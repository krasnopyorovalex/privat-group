<?php

namespace App\Domain\OurServiceItemImage\Commands;

use App\Domain\OurServiceItemImage\Queries\GetOurServiceItemImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateOurServiceItemImageCommand
 * @package App\Domain\OurServiceItemImage\Commands
 */
class UpdateOurServiceItemImageCommand
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
        $image = $this->dispatch(new GetOurServiceItemImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}

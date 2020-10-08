<?php

namespace App\Domain\OurServiceItemImage\Commands;

use App\Domain\OurServiceItemImage\Queries\GetOurServiceItemImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteOurServiceItemImageCommand
 * @package App\Domain\OurServiceItemImage\Commands
 */
class DeleteOurServiceItemImageCommand
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
        $image = $this->dispatch(new GetOurServiceItemImageByIdQuery($this->id));

        \Storage::delete([
            'public/our_service_item/' . $image->our_service_item_id . '/' . $image->basename . '.' . $image->ext,
            'public/our_service_item/' . $image->our_service_item_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}

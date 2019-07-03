<?php

namespace App\Domain\OurServiceItem\Commands;

use App\Domain\OurServiceItem\Queries\GetOurServiceItemByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteOurServiceItemCommand
 * @package App\Domain\OurServiceItem\Commands
 */
class DeleteOurServiceItemCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteCatalogCommand constructor.
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
        $ourServiceItem = $this->dispatch(new GetOurServiceItemByIdQuery($this->id));

        if($ourServiceItem->image) {
            $this->dispatch(new DeleteImageCommand($ourServiceItem->image));
        }

        Storage::deleteDirectory('public/our_service_item/' . $this->id);

        return $ourServiceItem->delete();
    }
}

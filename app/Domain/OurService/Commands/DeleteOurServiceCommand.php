<?php

namespace App\Domain\OurService\Commands;

use App\Domain\OurService\Queries\GetOurServiceByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteOurServiceCommand
 * @package App\Domain\OurService\Commands
 */
class DeleteOurServiceCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteOurServiceCommand constructor.
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
        $ourService = $this->dispatch(new GetOurServiceByIdQuery($this->id));

        if($ourService->image) {
            $this->dispatch(new DeleteImageCommand($ourService->image));
        }

        return $ourService->delete();
    }

}

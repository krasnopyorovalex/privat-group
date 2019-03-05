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
        $OurService = $this->dispatch(new GetOurServiceByIdQuery($this->id));

        if($OurService->image) {
            $this->dispatch(new DeleteImageCommand($OurService->image));
        }

        return $OurService->delete();
    }

}

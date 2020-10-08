<?php

namespace App\Domain\Advantage\Commands;

use App\Domain\Advantage\Queries\GetAdvantageByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteAdvantageCommand
 * @package App\Domain\Advantage\Commands
 */
class DeleteAdvantageCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteAdvantageCommand constructor.
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
        $advantage = $this->dispatch(new GetAdvantageByIdQuery($this->id));

        if($advantage->image) {
            $this->dispatch(new DeleteImageCommand($advantage->image));
        }

        return $advantage->delete();
    }

}

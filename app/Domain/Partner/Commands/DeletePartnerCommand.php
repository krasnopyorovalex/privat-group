<?php

namespace App\Domain\Partner\Commands;

use App\Domain\Partner\Queries\GetPartnerByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeletePartnerCommand
 * @package App\Domain\Partner\Commands
 */
class DeletePartnerCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeletePartnerCommand constructor.
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
        $partner = $this->dispatch(new GetPartnerByIdQuery($this->id));

        if($partner->image) {
            $this->dispatch(new DeleteImageCommand($partner->image));
        }

        return $partner->delete();
    }

}
<?php

namespace App\Domain\Tab\Commands;

use App\Domain\Tab\Queries\GetTabByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteTabCommand
 * @package App\Domain\Tab\Commands
 */
class DeleteTabCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeletePageCommand constructor.
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
        $tab = $this->dispatch(new GetTabByIdQuery($this->id));

        return $tab->delete();
    }

}
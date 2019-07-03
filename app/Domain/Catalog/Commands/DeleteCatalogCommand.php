<?php

namespace App\Domain\Catalog\Commands;

use App\Domain\Catalog\Queries\GetCatalogByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteCatalogCommand
 * @package App\Domain\Catalog\Commands
 */
class DeleteCatalogCommand
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
        $catalog = $this->dispatch(new GetCatalogByIdQuery($this->id));

        if($catalog->image) {
            $this->dispatch(new DeleteImageCommand($catalog->image));
        }

        return $catalog->delete();
    }

}
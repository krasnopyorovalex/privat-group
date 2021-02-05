<?php

declare(strict_types=1);

namespace App\Domain\City\Commands;

use App\Domain\City\Queries\GetCityByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteCityCommand
 * @package App\Domain\City\Commands
 */
class DeleteCityCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteCityCommand constructor.
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
        $city = $this->dispatch(new GetCityByIdQuery($this->id));

        return $city->delete();
    }

}
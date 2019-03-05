<?php

namespace App\Domain\OurService\Queries;

use App\OurService;

/**
 * Class GetAllOurServicesQuery
 * @package App\Domain\OurService\Queries
 */
class GetAllOurServicesQuery
{
    private static $ourServices;

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (! self::$ourServices) {
            self::$ourServices = OurService::with(['image'])->get();
        }

        return self::$ourServices;
    }
}

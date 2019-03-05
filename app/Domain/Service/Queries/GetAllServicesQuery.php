<?php

namespace App\Domain\Service\Queries;

use App\Service;

/**
 * Class GetAllServicesQuery
 * @package App\Domain\Service\Queries
 */
class GetAllServicesQuery
{
    private static $services;

    /**
     * @var Service|null
     */
    private $excludeService;

    /**
     * GetAllServicesQuery constructor.
     * @param Service|null $excludeService
     */
    public function __construct(Service $excludeService = null)
    {
        $this->excludeService = $excludeService;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ( ! self::$services) {
            $query = Service::where('parent_id', null)->with(['image','services' => function($query){
                return $query->orderBy('pos');
            }])->orderBy('pos');

            if ($this->excludeService) {
                return $query->where('id', '<>', $this->excludeService->id)->get();
            }

            self::$services = $query->get();
        }

        return self::$services;
    }
}
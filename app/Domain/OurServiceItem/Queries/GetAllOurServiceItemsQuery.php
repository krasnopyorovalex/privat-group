<?php

namespace App\Domain\OurServiceItem\Queries;

use App\Catalog;
use App\OurServiceItem;

/**
 * Class GetAllCatalogsQuery
 * @property Catalog catalog
 * @package App\Domain\OurServiceItem\Queries
 */
class GetAllOurServiceItemsQuery
{
    private $ourService;

    private $excludedId;

    /**
     * GetAllOurServiceItemsQuery constructor.
     * @param null $ourService
     * @param null $excludedId
     */
    public function __construct($ourService = null, $excludedId = null)
    {
        $this->ourService = $ourService;
        $this->excludedId = $excludedId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = OurServiceItem::with(['ourService']);

        if ($this->ourService) {
            $query->where('our_service_id', $this->ourService);
        }

        if ($this->excludedId) {
            $query->where('id', '<>', $this->excludedId);
        }

        return $query->get();
    }
}

<?php

namespace App\Domain\OurServiceItem\Queries;

use App\OurServiceItem;

/**
 * Class GetOurServiceItemByAliasQuery
 * @package App\Domain\OurServiceItem\Queries
 */
class GetOurServiceItemByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetOurServiceItemByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return OurServiceItem::where('alias', $this->alias)->firstOrFail();
    }
}

<?php

namespace App\Domain\OurService\Queries;

use App\OurService;

/**
 * Class GetOurServiceByAliasQuery
 * @package App\Domain\OurService\Queries
 */
class GetOurServiceByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetOurServiceByAliasQuery constructor.
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
        return OurService::with(['image'])->where('alias', $this->alias)->firstOrFail();
    }
}

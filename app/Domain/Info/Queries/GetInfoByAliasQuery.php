<?php

namespace App\Domain\Info\Queries;

use App\Info;

/**
 * Class GetInfoByAliasQuery
 * @package App\Domain\Info\Queries
 */
class GetInfoByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetInfoByAliasQuery constructor.
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
        return Info::with(['image'])->where('alias', $this->alias)->firstOrFail();
    }
}

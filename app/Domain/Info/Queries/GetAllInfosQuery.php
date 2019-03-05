<?php

namespace App\Domain\Info\Queries;

use App\Info;

/**
 * Class GetAllInfosQuery
 * @package App\Domain\Info\Queries
 */
class GetAllInfosQuery
{
    /**
     * @var bool
     */
    private $isPublished;

    /**
     * @var int
     */
    private $limit;

    /**
     * GetAllInfosQuery constructor.
     * @param bool $isPublished
     * @param int $limit
     */
    public function __construct(bool $isPublished = false, int $limit = 0)
    {
        $this->isPublished = $isPublished;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $infos = new Info();
        $infos = $infos->orderBy('published_at', 'desc');

        if ($this->isPublished) {
            $infos->where('is_published', '1');
        }

        if ($this->limit) {
            return $infos->paginate($this->limit, array('*'), 'page', intval(request('page')));
        }

        return $infos->get();
    }
}

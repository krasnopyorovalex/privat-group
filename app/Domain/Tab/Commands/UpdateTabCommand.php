<?php

namespace App\Domain\Tab\Commands;

use App\Domain\Tab\Queries\GetTabByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateTabCommand
 * @package App\Domain\Tab\Commands
 */
class UpdateTabCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateTabCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $tab = $this->dispatch(new GetTabByIdQuery($this->id));

        return $tab->update($this->request->all());
    }

}
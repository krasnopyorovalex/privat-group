<?php

namespace App\Domain\Tab\Commands;

use App\Http\Requests\Request;
use App\Tab;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateTabCommand
 * @package App\Domain\Tab\Commands
 */
class CreateTabCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateTabCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $tab = new Tab();
        $tab->fill($this->request->all());

        return $tab->save();
    }

}
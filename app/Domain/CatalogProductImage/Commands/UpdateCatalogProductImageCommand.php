<?php

namespace App\Domain\CatalogProductImage\Commands;

use App\Domain\CatalogProductImage\Queries\GetCatalogProductImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateCatalogProductImageCommand
 * @package App\Domain\CatalogProductImage\Commands
 */
class UpdateCatalogProductImageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateCatalogProductImageCommand constructor.
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
        $image = $this->dispatch(new GetCatalogProductImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}

<?php

namespace App\Domain\CatalogProductImage\Commands;

use App\Domain\CatalogProductImage\Queries\GetCatalogProductImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsCatalogProductImageCommand
 * @package App\Domain\CatalogProductImage\Commands
 */
class UpdatePositionsCatalogProductImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsCatalogProductImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if (is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetCatalogProductImageByIdQuery($imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}

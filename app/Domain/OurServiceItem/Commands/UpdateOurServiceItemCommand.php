<?php

namespace App\Domain\OurServiceItem\Commands;

use App\OurServiceItem;
use App\Domain\OurServiceItem\Queries\GetOurServiceItemByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateOurServiceItemCommand
 * @package App\Domain\OurServiceItem\Commands
 */
class UpdateOurServiceItemCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateCatalogCommand constructor.
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
        $ourServiceItem = $this->dispatch(new GetOurServiceItemByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($ourServiceItem->getOriginal('alias') !== $urlNew) {
            event(new RedirectDetected($ourServiceItem->getOriginal('alias'), str_slug($urlNew), 'catalog_product.show'));
        }

        if ($this->request->has('image')) {
            if ($ourServiceItem->image) {
                $this->dispatch(new DeleteImageCommand($ourServiceItem->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $ourServiceItem->id, OurServiceItem::class));
        }

        return $ourServiceItem->update($this->request->all());
    }
}

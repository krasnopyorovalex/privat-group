<?php

namespace App\Domain\OurServiceItem\Commands;

use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\OurServiceItem;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateOurServiceItemCommand
 * @package App\Domain\OurServiceItem\Commands
 */
class CreateOurServiceItemCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateCatalogCommand constructor.
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
        $ourServiceItem = new OurServiceItem();
        $ourServiceItem->fill($this->request->all());

        $ourServiceItem->save();

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $ourServiceItem->id, OurServiceItem::class));
        }

        return true;
    }
}

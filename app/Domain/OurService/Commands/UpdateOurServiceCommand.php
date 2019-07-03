<?php

namespace App\Domain\OurService\Commands;

use App\OurService;
use App\Domain\OurService\Queries\GetOurServiceByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateOurServiceCommand
 * @package App\Domain\Page\Commands
 */
class UpdateOurServiceCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateOurServiceCommand constructor.
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
        $ourService = $this->dispatch(new GetOurServiceByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($ourService->getOriginal('alias') !== $urlNew) {
            event(new RedirectDetected($ourService->getOriginal('alias'), $urlNew, 'our_service.show'));
        }

        if ($this->request->has('image')) {
            if ($ourService->image) {
                $this->dispatch(new DeleteImageCommand($ourService->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $ourService->id, OurService::class));
        }

        return $ourService->update($this->request->all());
    }

}

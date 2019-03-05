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
        $OurService = $this->dispatch(new GetOurServiceByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($OurService->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($OurService->getOriginal('alias'), $urlNew, 'OurService.show'));
        }

        if ($this->request->has('image')) {
            if ($OurService->image) {
                $this->dispatch(new DeleteImageCommand($OurService->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $OurService->id, OurService::class));
        }

        return $OurService->update($this->request->all());
    }

}

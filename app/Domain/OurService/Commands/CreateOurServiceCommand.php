<?php

namespace App\Domain\OurService\Commands;

use App\OurService;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateOurServiceCommand
 * @package App\Domain\OurService\Commands
 */
class CreateOurServiceCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateOurServiceCommand constructor.
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
        $ourService = new OurService();
        $ourService->fill($this->request->all());
        $ourService->save();

        if ($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $ourService->id, OurService::class));
        }

        return true;
    }

}

<?php

namespace App\Domain\Advantage\Commands;

use App\Advantage;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateAdvantageCommand
 * @package App\Domain\Advantage\Commands
 */
class CreateAdvantageCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateAdvantageCommand constructor.
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
        $advantage = new Advantage();
        $advantage->fill($this->request->all());
        $advantage->save();

        if ($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $advantage->id, Advantage::class));
        }

        return true;
    }

}

<?php

namespace App\Domain\Advantage\Commands;

use App\Advantage;
use App\Domain\Advantage\Queries\GetAdvantageByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateAdvantageCommand
 * @package App\Domain\Page\Commands
 */
class UpdateAdvantageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateAdvantageCommand constructor.
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
        $advantage = $this->dispatch(new GetAdvantageByIdQuery($this->id));

        if ($this->request->has('image')) {
            if ($advantage->image) {
                $this->dispatch(new DeleteImageCommand($advantage->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $advantage->id, Advantage::class));
        }

        return $advantage->update($this->request->all());
    }

}

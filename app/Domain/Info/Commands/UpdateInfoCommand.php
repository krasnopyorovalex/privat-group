<?php

namespace App\Domain\Info\Commands;

use App\Info;
use App\Domain\Info\Queries\GetInfoByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateInfoCommand
 * @package App\Domain\Page\Commands
 */
class UpdateInfoCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateInfoCommand constructor.
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
        $info = $this->dispatch(new GetInfoByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($info->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($info->getOriginal('alias'), $urlNew, 'new.show'));
        }

        if ($this->request->has('image')) {
            if ($info->image) {
                $this->dispatch(new DeleteImageCommand($info->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $info->id, Info::class));
        }

        return $info->update($this->request->all());
    }

}

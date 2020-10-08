<?php

namespace App\Domain\Partner\Commands;

use App\Partner;
use App\Domain\Partner\Queries\GetPartnerByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdatePartnerCommand
 * @package App\Domain\Partner\Commands
 */
class UpdatePartnerCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdatePartnerCommand constructor.
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
        $partner = $this->dispatch(new GetPartnerByIdQuery($this->id));

        if ($this->request->has('image')) {
            if ($partner->image) {
                $this->dispatch(new DeleteImageCommand($partner->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $partner->id, Partner::class));
        }

        return $partner->update($this->request->all());
    }

}
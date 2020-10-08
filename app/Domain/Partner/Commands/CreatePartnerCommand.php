<?php

namespace App\Domain\Partner\Commands;

use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Partner;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreatePartnerCommand
 * @package App\Domain\Partner\Commands
 */
class CreatePartnerCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreatePartnerCommand constructor.
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
        $partner = new Partner();
        $partner->fill($this->request->all());
        $partner->save();

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $partner->id, Partner::class));
        }

        return true;
    }

}
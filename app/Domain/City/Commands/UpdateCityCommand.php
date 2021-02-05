<?php

declare(strict_types=1);

namespace App\Domain\City\Commands;

use App\Domain\City\Queries\GetCityByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateCityCommand
 * @package App\Domain\City\Commands
 */
class UpdateCityCommand
{

    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateCityCommand constructor.
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
        $city = $this->dispatch(new GetCityByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($city->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($city->getOriginal('alias'), $urlNew));
        }

        return $city->update($this->request->all());
    }

}
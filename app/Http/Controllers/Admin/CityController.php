<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\City\Queries\GetAllCitiesQuery;
use App\Domain\City\Commands\CreateCityCommand;
use App\Domain\City\Commands\DeleteCityCommand;
use App\Domain\City\Commands\UpdateCityCommand;
use App\Domain\City\Queries\GetCityByIdQuery;
use App\Http\Controllers\Controller;
use Domain\City\Requests\CreateCityRequest;
use Domain\City\Requests\UpdateCityRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class CityController
 * @package App\Http\Controllers\Admin
 */
class CityController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $cities = $this->dispatch(new GetAllCitiesQuery());

        return view('admin.cities.index', [
            'cities' => $cities
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * @param CreateCityRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCityRequest $request)
    {
        $this->dispatch(new CreateCityCommand($request));

        return redirect(route('admin.cities.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $city = $this->dispatch(new GetCityByIdQuery($id));

        return view('admin.cities.edit', [
            'city' => $city
        ]);
    }

    /**
     * @param int $id
     * @param UpdateCityRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateCityRequest $request)
    {
        $this->dispatch(new UpdateCityCommand($id, $request));

        return redirect(route('admin.cities.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteCityCommand($id));

        return redirect(route('admin.cities.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Advantage\Commands\CreateAdvantageCommand;
use App\Domain\Advantage\Commands\DeleteAdvantageCommand;
use App\Domain\Advantage\Commands\UpdateAdvantageCommand;
use App\Domain\Advantage\Queries\GetAllAdvantagesQuery;
use App\Domain\Advantage\Queries\GetAdvantageByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Advantage\Requests\CreateAdvantageRequest;
use Domain\Advantage\Requests\UpdateAdvantageRequest;

/**
 * Class AdvantageController
 * @package App\Http\Controllers\Admin
 */
class AdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advantages = $this->dispatch(new GetAllAdvantagesQuery);

        return view('admin.advantages.index', [
            'advantages' => $advantages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advantages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAdvantageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateAdvantageRequest $request)
    {
        $this->dispatch(new CreateAdvantageCommand($request));

        return redirect(route('admin.advantages.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advantage = $this->dispatch(new GetAdvantageByIdQuery($id));

        return view('admin.advantages.edit', [
            'advantage' => $advantage
        ]);
    }

    /**
     * @param $id
     * @param UpdateAdvantageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateAdvantageRequest $request)
    {
        $this->dispatch(new UpdateAdvantageCommand($id, $request));

        return redirect(route('admin.advantages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteAdvantageCommand($id));

        return redirect(route('admin.advantages.index'));
    }
}

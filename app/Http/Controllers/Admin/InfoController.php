<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Info\Commands\CreateInfoCommand;
use App\Domain\Info\Commands\DeleteInfoCommand;
use App\Domain\Info\Commands\UpdateInfoCommand;
use App\Domain\Info\Queries\GetAllInfosQuery;
use App\Domain\Info\Queries\GetInfoByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Info\Requests\CreateInfoRequest;
use Domain\Info\Requests\UpdateInfoRequest;

/**
 * Class InfoController
 * @package App\Http\Controllers\Admin
 */
class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = $this->dispatch(new GetAllInfosQuery());

        return view('admin.infos.index', [
            'infos' => $infos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.infos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateInfoRequest $request)
    {
        $this->dispatch(new CreateInfoCommand($request));

        return redirect(route('admin.infos.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->dispatch(new GetInfoByIdQuery($id));

        return view('admin.infos.edit', [
            'info' => $info
        ]);
    }

    /**
     * @param $id
     * @param UpdateInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateInfoRequest $request)
    {
        $this->dispatch(new UpdateInfoCommand($id, $request));

        return redirect(route('admin.infos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteInfoCommand($id));

        return redirect(route('admin.infos.index'));
    }
}

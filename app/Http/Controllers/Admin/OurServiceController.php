<?php

namespace App\Http\Controllers\Admin;

use App\Domain\OurService\Commands\CreateOurServiceCommand;
use App\Domain\OurService\Commands\DeleteOurServiceCommand;
use App\Domain\OurService\Commands\UpdateOurServiceCommand;
use App\Domain\OurService\Queries\GetAllOurServicesQuery;
use App\Domain\OurService\Queries\GetOurServiceByIdQuery;
use App\Http\Controllers\Controller;
use App\OurService;
use Domain\OurService\Requests\CreateOurServiceRequest;
use Domain\OurService\Requests\UpdateOurServiceRequest;

/**
 * Class OurServiceController
 * @package App\Http\Controllers\Admin
 */
class OurServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourServices = $this->dispatch(new GetAllOurServicesQuery());

        return view('admin.our_services.index', [
            'ourServices' => $ourServices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ourService = new OurService();

        return view('admin.our_services.create', ['ourService' => $ourService]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOurServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateOurServiceRequest $request)
    {
        $this->dispatch(new CreateOurServiceCommand($request));

        return redirect(route('admin.our_services.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ourService = $this->dispatch(new GetOurServiceByIdQuery($id));

        return view('admin.our_services.edit', [
            'ourService' => $ourService
        ]);
    }

    /**
     * @param $id
     * @param UpdateOurServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateOurServiceRequest $request)
    {
        $this->dispatch(new UpdateOurServiceCommand($id, $request));

        return redirect(route('admin.our_services.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteOurServiceCommand($id));

        return redirect(route('admin.our_services.index'));
    }
}

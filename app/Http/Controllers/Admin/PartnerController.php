<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Partner\Commands\CreatePartnerCommand;
use App\Domain\Partner\Commands\DeletePartnerCommand;
use App\Domain\Partner\Commands\UpdatePartnerCommand;
use App\Domain\Partner\Queries\GetAllPartnersQuery;
use App\Domain\Partner\Queries\GetPartnerByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Partner\Requests\CreatePartnerRequest;
use Domain\Partner\Requests\UpdatePartnerRequest;

/**
 * Class PartnerController
 * @package App\Http\Controllers\Admin
 */
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = $this->dispatch(new GetAllPartnersQuery());

        return view('admin.partners.index', [
            'partners' => $partners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePartnerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreatePartnerRequest $request)
    {
        $this->dispatch(new CreatePartnerCommand($request));

        return redirect(route('admin.partners.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = $this->dispatch(new GetPartnerByIdQuery($id));

        return view('admin.partners.edit', [
            'partner' => $partner
        ]);
    }

    /**
     * @param $id
     * @param UpdatePartnerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdatePartnerRequest $request)
    {
        $this->dispatch(new UpdatePartnerCommand($id, $request));

        return redirect(route('admin.partners.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeletePartnerCommand($id));

        return redirect(route('admin.partners.index'));
    }
}
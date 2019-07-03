<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Catalog\Commands\CreateCatalogCommand;
use App\Domain\Catalog\Commands\DeleteCatalogCommand;
use App\Domain\Catalog\Commands\UpdateCatalogCommand;
use App\Domain\Catalog\Queries\GetAllCatalogsNotParentQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\Catalog\Queries\GetCatalogByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\TreeRecursiveBuildService;
use Domain\Catalog\Requests\CreateCatalogRequest;
use Domain\Catalog\Requests\UpdateCatalogRequest;

/**
 * @property  treeRecursiveBuildService
 */
class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsNotParentQuery());

        return view('admin.catalogs.index', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsQuery());

        return view('admin.catalogs.create', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCatalogRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateCatalogRequest $request)
    {
        $this->dispatch(new CreateCatalogCommand($request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = $this->dispatch(new GetCatalogByIdQuery($id));
        $catalogs = $this->dispatch(new GetAllCatalogsQuery($catalog));

        return view('admin.catalogs.edit', [
            'catalog' => $catalog,
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @param $id
     * @param UpdateCatalogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateCatalogRequest $request)
    {
        $this->dispatch(new UpdateCatalogCommand($id, $request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteCatalogCommand($id));

        return redirect(route('admin.catalogs.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domain\OurService\Queries\GetOurServiceByIdQuery;
use App\OurServiceItem;
use App\Domain\OurServiceItem\Commands\CreateOurServiceItemCommand;
use App\Domain\OurServiceItem\Commands\DeleteOurServiceItemCommand;
use App\Domain\OurServiceItem\Commands\UpdateOurServiceItemCommand;
use App\Domain\OurServiceItem\Queries\GetAllOurServiceItemsQuery;
use App\Domain\OurServiceItem\Queries\GetOurServiceItemByIdQuery;
use App\Http\Controllers\Controller;
use Domain\OurServiceItem\Requests\CreateOurServiceItemRequest;
use Domain\OurServiceItem\Requests\UpdateOurServiceItemRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

/**
 * Class OurServiceItemController
 * @package App\Http\Controllers\Admin
 */
class OurServiceItemController extends Controller
{
    /**
     * @param int $our_service
     * @return Factory|View
     */
    public function index(int $our_service)
    {
        $ourServiceItems = $this->dispatch(new GetAllOurServiceItemsQuery($our_service));

        return view('admin.our_service_items.index', [
            'ourServiceItems' => $ourServiceItems,
            'ourService' => $our_service
        ]);
    }

    /**
     * @param $our_service
     * @return Factory|View
     */
    public function create($our_service)
    {
        return view('admin.our_service_items.create', [
            'ourService' => $our_service
        ]);
    }

    /**
     * @param CreateOurServiceItemRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateOurServiceItemRequest $request)
    {
        $this->dispatch(new CreateOurServiceItemCommand($request));

        return redirect(route('admin.our_service_items.index',[
            'our_service' => (int)$request->get('our_service_id')
        ]));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $ourServiceItem = $this->dispatch(new GetOurServiceItemByIdQuery($id));

        return view('admin.our_service_items.edit', [
            'ourServiceItem' => $ourServiceItem
        ]);
    }

    /**
     * @param $id
     * @param UpdateOurServiceItemRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, UpdateOurServiceItemRequest $request)
    {
        $this->dispatch(new UpdateOurServiceItemCommand($id, $request));
        $ourServiceItem = $this->dispatch(new GetOurServiceItemByIdQuery($id));

        return redirect(route('admin.our_service_items.index', [
            'our_service' => $ourServiceItem->our_service_id
        ]));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function destroy($id, Request $request)
    {
        $this->dispatch(new DeleteOurServiceItemCommand($id));

        return redirect(route('admin.our_service_items.index', [
            'our_service' => $request->post('our_service_id')
        ]));
    }
}

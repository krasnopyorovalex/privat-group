<?php

namespace App\Http\Controllers\Admin;

use App\Domain\OurServiceItem\Queries\GetOurServiceItemByIdQuery;
use App\Domain\OurServiceItemImage\Commands\CreateOurServiceItemImageCommand;
use App\Domain\OurServiceItemImage\Commands\DeleteOurServiceItemImageCommand;
use App\Domain\OurServiceItemImage\Commands\UpdateOurServiceItemImageCommand;
use App\Domain\OurServiceItemImage\Commands\UpdatePositionsOurServiceItemImageCommand;
use App\Domain\OurServiceItemImage\Queries\GetOurServiceItemImageByIdQuery;
use Domain\OurServiceItemImage\Requests\CreateOurServiceItemImageRequest;
use Domain\OurServiceItemImage\Requests\UpdateOurServiceItemImageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;

/**
 * Class OurServiceItemImageController
 * @package App\Http\Controllers\Admin
 */
class OurServiceItemImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private $uploadGalleryImagesService;

    /**
     * GalleryImageController constructor.
     * @param UploadImagesService $uploadGalleryImagesService
     */
    public function __construct(UploadImagesService $uploadGalleryImagesService)
    {
        $this->uploadGalleryImagesService = $uploadGalleryImagesService;
    }

    /**
     * @param int $our_service_item
     * @return array
     * @throws \Throwable
     */
    public function index(int $our_service_item): array
    {
        $ourServiceItem = $this->dispatch(new GetOurServiceItemByIdQuery($our_service_item));

        return [
            'images' => view('admin.our_service_items._images_box', [
                'ourServiceItem' => $ourServiceItem
            ])->render()
        ];
    }

    /**
     * @param CreateOurServiceItemImageRequest $request
     * @param $ourServiceItem
     * @return array
     */
    public function store(CreateOurServiceItemImageRequest $request, $ourServiceItem): array
    {
        $image = $this->uploadGalleryImagesService->setWidthThumb(320)->upload($request, 'our_service_item', $ourServiceItem);

        $this->dispatch(new CreateOurServiceItemImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id): string
    {
        $image = $this->dispatch(new GetOurServiceItemImageByIdQuery($id));

        return view('admin.our_service_items._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param $id
     * @param UpdateOurServiceItemImageRequest $request
     * @return array
     * @throws \Throwable
     */
    public function update($id, UpdateOurServiceItemImageRequest $request): array
    {
        $this->dispatch(new UpdateOurServiceItemImageCommand($id, $request));
        $image = $this->dispatch(new GetOurServiceItemImageByIdQuery($id));

        return [
            'images' => view('admin.our_service_items._images_box', [
                'ourServiceItem' => $image->ourServiceItem
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id): array
    {
        $this->dispatch(new DeleteOurServiceItemImageCommand($id));

        return [
            'message' => 'Изображение удалено успешно'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updatePositions(Request $request): array
    {
        $this->dispatch(new UpdatePositionsOurServiceItemImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}

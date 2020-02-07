<?php

namespace App\Http\Controllers\Admin;

use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use App\Domain\CatalogProductImage\Commands\CreateCatalogProductImageCommand;
use App\Domain\CatalogProductImage\Commands\DeleteCatalogProductImageCommand;
use App\Domain\CatalogProductImage\Commands\UpdatePositionsCatalogProductImageCommand;
use App\Domain\CatalogProductImage\Commands\UpdateCatalogProductImageCommand;
use App\Domain\CatalogProductImage\Queries\GetCatalogProductImageByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\CatalogProductImage\Requests\CreateCatalogProductImageRequest;
use Domain\CatalogProductImage\Requests\UpdateCatalogProductImageRequest;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class CatalogProductImageController
 * @package App\Http\Controllers\Admin
 */
class CatalogProductImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private $uploadCatalogProductImagesService;

    /**
     * CatalogProductImageController constructor.
     * @param UploadImagesService $uploadCatalogProductImagesService
     */
    public function __construct(UploadImagesService $uploadCatalogProductImagesService)
    {
        $this->uploadCatalogProductImagesService = $uploadCatalogProductImagesService;
    }

    /**
     * @param int $catalogProduct
     * @return array
     * @throws Throwable
     */
    public function index(int $catalogProduct): array
    {
        $catalogProduct = $this->dispatch(new GetCatalogProductByIdQuery($catalogProduct));

        return [
            'images' => view('admin.catalog_products._images_box', [
                'catalogProduct' => $catalogProduct
            ])->render()
        ];
    }

    /**
     * @param CreateCatalogProductImageRequest $request
     * @param $catalogProduct
     * @return array
     */
    public function store(CreateCatalogProductImageRequest $request, $catalogProduct): array
    {
        $image = $this->uploadCatalogProductImagesService->upload($request, 'catalog_products', $catalogProduct);
        $this->dispatch(new CreateCatalogProductImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param $id
     * @return string
     * @throws Throwable
     */
    public function edit($id): string
    {
        $image = $this->dispatch(new GetCatalogProductImageByIdQuery($id));

        return view('admin.catalog_products._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateCatalogProductImageRequest $request
     * @return array
     * @throws Throwable
     */
    public function update(int $id, UpdateCatalogProductImageRequest $request): array
    {
        $this->dispatch(new UpdateCatalogProductImageCommand($id, $request));

        $image = $this->dispatch(new GetCatalogProductImageByIdQuery($id));
        $catalogProduct = $this->dispatch(new GetCatalogProductByIdQuery($image->catalog_product_id));

        return [
            'images' => view('admin.catalog_products._images_box', [
                'catalogProduct' => $catalogProduct
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
        $this->dispatch(new DeleteCatalogProductImageCommand($id));

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
        $this->dispatch(new UpdatePositionsCatalogProductImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}

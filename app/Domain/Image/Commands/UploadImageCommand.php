<?php

namespace App\Domain\Image\Commands;

use App\CatalogProduct;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Intervention\Image\ImageManager;
use Storage;

/**
 * Class UploadImageCommand
 * @package App\Domain\Image\Commands
 */
class UploadImageCommand
{
    use DispatchesJobs;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var int
     */
    private $imageableId;

    /**
     * @var string
     */
    private $imageableType;

    /**
     * UploadImageCommand constructor.
     * @param Request $request
     * @param int $imageableId
     * @param string $imageableType
     */
    public function __construct(Request $request, int $imageableId, string $imageableType)
    {
        $this->request = $request;
        $this->imageableId = $imageableId;
        $this->imageableType = $imageableType;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $path = $this->request->file('image')->store('public/images');

        if ($this->imageableType === CatalogProduct::class) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            (new ImageManager())
                ->make(Storage::path($path))
                ->resize(360, 360)
                ->save(str_replace('.'.$extension, '_thumb.' . $extension, Storage::path($path)));
        }

//        $im = (new ImageManager())->make(Storage::path($path));

//        $imHeight = $im->height();
//        $imWidth = $im->width();

//        $im->text('fabrikabani-krym.ru', abs($imWidth/2), abs($imHeight/2), static function($font) {
//            $font->file(public_path('fonts/Arial-Black.ttf'));
//            $font->size(24);
//            $font->color(array(255, 255, 255, 0.6));
//            $font->align('center');
//            $font->valign('middle');
//            $font->angle(45);
//        })->save(Storage::path($path));

        return $this->dispatch(new CreateImageCommand([
            'path' => Storage::url($path),
            'imageable_id' => $this->imageableId,
            'imageable_type' => $this->imageableType
        ]));
    }

}

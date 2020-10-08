<?php

namespace App\Http\ViewComposers;

use App\Domain\Gallery\Queries\GetAllGalleriesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GalleryComposer
 * @package App\Http\ViewComposers
 */
class GalleryComposer
{
    use DispatchesJobs;

    private static $gallery;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if (! self::$gallery) {
            self::$gallery = $this->dispatch(new GetAllGalleriesQuery());
        }

        $view->with('gallery', self::$gallery);
    }
}

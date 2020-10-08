<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;
use App\Http\ViewComposers\GalleryComposer;

/**
 * Class GalleryServiceProvider
 * @package App\Providers
 */
class GalleryServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('page.gallery', GalleryComposer::class);
    }
}

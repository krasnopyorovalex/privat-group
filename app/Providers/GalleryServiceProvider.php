<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class GalleryServiceProvider
 * @package App\Providers
 */
class GalleryServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('view')->composer('page.gallery', 'App\Http\ViewComposers\GalleryComposer');
    }
}

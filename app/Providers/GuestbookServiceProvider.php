<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class GuestbookServiceProvider
 * @package App\Providers
 */
class GuestbookServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('view')->composer('*', 'App\Http\ViewComposers\GuestbookComposer');
    }
}

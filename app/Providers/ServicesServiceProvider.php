<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ServicesServiceProvider
 * @package App\Providers
 */
class ServicesServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('view')->composer('*', 'App\Http\ViewComposers\ServiceComposer');
    }
}

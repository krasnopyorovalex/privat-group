<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class OurServicesServiceProvider
 * @package App\Providers
 */
class OurServicesServiceProvider extends ServiceProvider
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('view')->composer('*', 'App\Http\ViewComposers\OurServiceComposer');
    }
}

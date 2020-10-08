<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;
use App\Http\ViewComposers\OurServiceComposer;

/**
 * Class OurServicesServiceProvider
 * @package App\Providers
 */
class OurServicesServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['page.page','page.index'], OurServiceComposer::class);
    }
}

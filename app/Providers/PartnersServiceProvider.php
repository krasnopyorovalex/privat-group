<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Http\ViewComposers\PartnersComposer;

/**
 * Class PartnersServiceProvider
 * @package App\Providers
 */
class PartnersServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['page.index','layouts.sections.partners'], PartnersComposer::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;
use App\Http\ViewComposers\GuestbookComposer;

/**
 * Class GuestbookServiceProvider
 * @package App\Providers
 */
class GuestbookServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('*', GuestbookComposer::class);
    }
}

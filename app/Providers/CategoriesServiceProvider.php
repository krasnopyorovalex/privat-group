<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\CategoriesComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

/**
 * Class CategoriesServiceProvider
 * @package App\Providers
 */
class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['layouts.app'], CategoriesComposer::class);
    }
}

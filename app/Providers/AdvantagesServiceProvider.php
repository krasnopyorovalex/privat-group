<?php

namespace App\Providers;

use App\Http\ViewComposers\AdvantageComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

/**
 * Class AdvantagesServiceProvider
 * @package App\Providers
 */
class AdvantagesServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['page.index', 'layouts.section.advantages'], AdvantageComposer::class);
    }
}

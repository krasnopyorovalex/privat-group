<?php

namespace App\Domain\Cart\Commands;


/**
 * Class ClearCartCommand
 * @package App\Domain\Cart\Commands
 */
class ClearCartCommand
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return app('cart')->clear();
    }
}

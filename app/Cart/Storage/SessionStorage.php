<?php

namespace App\Cart\Storage;

use Darryldecode\Cart\CartCollection;
use Illuminate\Support\Facades\Session;

/**
 * Class SessionStorage
 * @package App\Cart\Storage
 */
class SessionStorage
{
    /**
     * @param $key
     * @return array|CartCollection
     */
    public function get($key)
    {
        if (session()->has($key)) {

            $data = session()->get($key);

            return new CartCollection(unserialize($data));
        }

        return [];
    }

    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value): void
    {
        session([$key => serialize($value)]);
    }
}

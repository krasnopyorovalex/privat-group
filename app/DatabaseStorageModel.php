<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseStorageModel
 * @package App
 */
class DatabaseStorageModel extends Model
{
    protected $table = 'cart_storage';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'cart_data',
    ];

    /**
     * @param $value
     */
    public function setCartDataAttribute($value): void
    {
        $this->attributes['cart_data'] = serialize($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OurServiceItem extends Model
{
    use AutoAliasTrait;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = ['image'];

    protected $with = [
        'images',
        'image'
    ];

    /**
     * @return HasOne
     */
    public function ourService(): HasOne
    {
        return $this->hasOne(OurService::class, 'id', 'our_service_id');
    }

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(OurServiceItemImage::class, 'our_service_item_id', 'id')->orderBy('pos');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OurService
 * @package App
 */
class OurService extends Model
{
    use AutoAliasTrait;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    protected $with = [
        'image',
        'ourServiceItems'
    ];

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
    public function ourServiceItems(): HasMany
    {
        return $this->hasMany(OurServiceItem::class);
    }
}

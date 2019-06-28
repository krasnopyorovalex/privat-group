<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Slider
 *
 * @property int $id
 * @property string $name
 * @property string $is_published
 * @property int $pos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SliderImage[] $images
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider wherePos($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider query()
 */
class Slider extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'is_published'];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(SliderImage::class)->orderBy('pos');
    }
}

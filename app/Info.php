<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Info extends Model
{
    use AutoAliasTrait;

    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('info.show', $this->alias);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return sprintf('%s', $this->title);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return sprintf('%s', $this->description);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['name', 'title', 'description', 'text', 'preview', 'alias', 'is_published', 'published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route("info.show", $this->alias);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 * @package App
 * @property-read \App\Image $image
 * @property-read \App\Service $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Service[] $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service query()
 * @mixin \Eloquent
 */
class Service extends Model
{
    use AutoAliasTrait;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'gallery_id', 'name', 'title', 'description', 'text', 'short_text', 'price', 'alias', 'is_published', 'pos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Service', 'parent_id', 'id')->orderBy('pos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Service', 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tabs()
    {
        return $this->hasMany(ServiceTab::class, 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function originTabs()
    {
        return $this->belongsToMany(Tab::class, 'service_tabs', 'service_id', 'tab_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relativeServices()
    {
        return $this->belongsToMany(Service::class, 'service_relatives', 'service_id', 'service_relative_id');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("service.show", $this->alias);
    }
}

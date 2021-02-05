<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Page
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $alias
 * @property string $publish
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @mixin Eloquent
 */
class City extends Model
{
    protected $guarded = ['alias'];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(CatalogProduct::class)->orderByDesc('label')->orderBy('created_at');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('city.show', $this->alias);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OurServiceItemImage extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['our_service_item_id', 'name', 'alt', 'title', 'basename', 'ext', 'is_published', 'pos'];

    /**
     * @return BelongsTo
     */
    public function ourServiceItem(): BelongsTo
    {
        return $this->belongsTo(OurServiceItem::class);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/our_service_item/' . $this->our_service_item_id . '/' . $this->basename . '.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/our_service_item/' . $this->our_service_item_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }
}

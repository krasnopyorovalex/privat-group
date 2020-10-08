<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\GalleryImage
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $name
 * @property string|null $alt
 * @property string|null $title
 * @property string $basename
 * @property string $ext
 * @property string $is_published
 * @property int $pos
 * @mixin \Eloquent
 * @property-read \App\Gallery $gallery
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereBasename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereGalleryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage wherePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GalleryImage whereTitle($value)
 */
class GalleryImage extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['gallery_id', 'name', 'alt', 'title', 'is_published', 'pos'];

    /**
     * @return BelongsTo
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/gallery/' . $this->gallery_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/gallery/' . $this->gallery_id . '/' . $this->basename . '.' . $this->ext);
    }
}

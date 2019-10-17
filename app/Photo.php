<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Photo
 *
 * @property int $id
 * @property int $albumId
 * @property string $title
 * @property string $url
 * @property string $thumbnailUrl
 * @property string $description
 * @property string $author
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Photo newModelQuery()
 * @method static Builder|Photo newQuery()
 * @method static Builder|Photo query()
 * @method static Builder|Photo whereAlbumId($value)
 * @method static Builder|Photo whereAuthor($value)
 * @method static Builder|Photo whereCreatedAt($value)
 * @method static Builder|Photo whereDescription($value)
 * @method static Builder|Photo whereId($value)
 * @method static Builder|Photo whereThumbnailUrl($value)
 * @method static Builder|Photo whereTitle($value)
 * @method static Builder|Photo whereUpdatedAt($value)
 * @method static Builder|Photo whereUrl($value)
 * @mixin Eloquent
 * @property-read Album $album
 */
class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'url', 'thumbnailUrl'];

    public function album()
    {
        return $this->belongsTo('App\Album', 'albumId');
    }
}

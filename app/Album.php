<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Album
 *
 * @property int $id
 * @property int $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Album newModelQuery()
 * @method static Builder|Album newQuery()
 * @method static Builder|Album query()
 * @method static Builder|Album whereCreatedAt($value)
 * @method static Builder|Album whereId($value)
 * @method static Builder|Album whereName($value)
 * @method static Builder|Album whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Photo[] $photos
 * @property-read int|null $photos_count
 */
class Album extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

    public function photos()
    {
        return $this->hasMany('App\Photo', 'albumId');
    }
}

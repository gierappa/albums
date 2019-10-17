<?php

namespace App\Http\Resources;

use App\Album;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AlbumResource
 *
 * @package App\Http\Resources
 * @mixin Album
 */
class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photos' => PhotoResource::collection($this->photos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'category'    => $this->category,
            'description' => $this->description,
            'visible'     => $this->visible,
            'order'       => $this->order,
            'status'      => $this->status,
            'image'       => Storage::url($this->image),
            'tags'        => TagResource::collection($this->whenLoaded('tags')),
            'links'       => LinkResource::collection($this->whenLoaded('links')),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}

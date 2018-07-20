<?php

namespace FTW\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use FTW\Http\Resources\Tag as TagResource;

class Blog extends JsonResource
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
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'image'       => $this->image,
            'image_path'  => $this->getImage(),
            'teaser'      => $this->teaser,
            'content'     => $this->content,
            'active'      => $this->active,
            'hot'         => $this->hot,
            'category_id' => $this->category_id,
            'author_id'   => $this->author_id,
            'tags'        => TagResource::collection($this->tags)
        ];
    }
}

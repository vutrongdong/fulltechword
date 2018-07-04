<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'teaser'      => $this->teaser,
            'content'     => $this->content,
            'active'      => $this->active,
            'hot'         => $this->hot,
            'category_id' => $this->category_id,
            'author_id'   => $this->author_id,
        ];
    }
}

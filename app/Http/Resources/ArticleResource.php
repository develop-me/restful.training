<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // make sure tags are up to date
        $this->resource->load("tags");

        return [
            "id" => (int) $this->id,
            "title" => $this->title,
            "content" => $this->content,

            // just return a list of tag names
            "tags" => $this->tags->pluck("name"),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalFactResource extends JsonResource
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
            "fact" => (string) $this->fact,
            "made_up" => (bool) $this->made_up,
            "by" => (string) $this->user->name,
        ];
    }
}

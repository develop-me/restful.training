<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PingPongListResource extends JsonResource
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
            "id" => $this->id,
            "complete" => $this->complete(),
            "player_1" => $this->player_1_score,
            "player_2" => $this->player_2_score,
        ];
    }
}

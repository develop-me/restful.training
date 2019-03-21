<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PingPongResource extends JsonResource
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
            "id" => (int) $this->id,
            "complete" => (bool) $this->complete(),
            "winning_score" => (int) $this->winning_score,
            "change_serve" => (int) $this->change_serve,
            "player_1" => [
                "name" => $this->player_1,
                "score" => (int) $this->player_1_score,
                "serving" => (bool) ($this->serving() === 1),
                "won" => (bool) $this->player1Won(),
            ],
            "player_2" => [
                "name" => $this->player_2,
                "score" => (int) $this->player_2_score,
                "serving" => (bool) ($this->serving() === 2),
                "won" => (bool) $this->player2Won(),
            ],
        ];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $attributes = [
        "player_1_score" => 0,
        "player_2_score" => 0,
        "winning_score" => 21,
        "change_serve" => 5,
    ];

    public function score(int $player)
    {
        $prop = "player_${player}_score";
        $this->$prop += 1;
        $this->save();
        return $this;
    }

    public function serving() : int
    {
        $total = $this->player_1_score + $this->player_2_score;
        return (floor($total / $this->change_serve) % 2) + 1;
    }

    public function player1Won() : bool
    {
        return $this->player_1_score >= $this->winning_score
            && $this->player_1_score - $this->player_2_score > 1;
    }

    public function player2Won() : bool
    {
        return $this->player_2_score >= $this->winning_score
            && $this->player_2_score - $this->player_1_score > 1;
    }

    public function complete() : bool
    {
        return $this->player1Won() || $this->player2Won();
    }
}
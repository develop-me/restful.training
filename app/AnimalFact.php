<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalFact extends Model
{
    protected $fillable = ["fact", "made_up", "user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

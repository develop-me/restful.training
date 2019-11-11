<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalFact extends Model
{
    protected $fillable = ["fact", "made_up", "account_id"];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function forUser(User $user) : Counter
    {
        $counter = Counter::where("user_id", $user->id)->first();
        return $counter ? $counter : Counter::create([
            "count" => 0,
            "step" => 1,
            "user_id" => $user->id,
        ]);
    }

    protected $fillable = ["count", "step", "user_id"];
}

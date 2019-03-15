<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    public static function forAccount(int $accountId) : Counter
    {
        $counter = Counter::where("account_id", $accountId)->first();
        return $counter ? $counter : Counter::create([
            "count" => 0,
            "step" => 1,
            "account_id" => $accountId
        ]);
    }

    protected $fillable = ["count", "step", "account_id"];
}

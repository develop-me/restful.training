<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ["task", "completed", "user_id"];
    protected $hidden = ["user_id"];
    protected $attributes = [
        "completed" => false,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

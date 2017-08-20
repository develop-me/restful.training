<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ["name"];

    public function getRouteKeyName()
    {
        return "name";
    }

    public function uri()
    {
        return $this->name . "." . config("app.hostname") . "/api";
    }
}

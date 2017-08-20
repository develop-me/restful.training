<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ["name", "key"];

    public function __construct($attributes = [])
    {
        if (!array_key_exists("key", $attributes)) {
            $attributes["key"] = sha1(time() . mt_rand(1, 1000000));
        }
        
        parent::__construct($attributes);
    }
    
    public function getRouteKeyName()
    {
        return "name";
    }

    public function uri()
    {
        return $this->name . "." . config("app.hostname") . "/api/";
    }
}
